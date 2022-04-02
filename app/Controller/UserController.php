<?php

class UserController extends AppController
{
    public $components = ['Session', 'Captcha', 'API'];

    function get_captcha()
    {
        $this->autoRender = false;
        App::import('Component', 'Captcha');
        //generate random charcters for captcha
        $random = mt_rand(100, 99999);
        //save characters in session
        $this->Session->write('captcha_code', $random);
        $settings = [
            'characters' => $random,
            'winHeight' => 50,         // captcha image height
            'winWidth' => 220,           // captcha image width
            'fontSize' => 25,          // captcha image characters fontsize
            'fontPath' => WWW_ROOT . 'tahomabd.ttf',    // captcha image font
            'noiseColor' => '#ccc',
            'bgColor' => '#fff',
            'noiseLevel' => '100',
            'textColor' => '#000'
        ];
        $img = $this->Captcha->ShowImage($settings);
        echo $img;
    }

    function ajax_login()
    {
        if (!$this->request->is('post'))
            throw new BadRequestException();
        if (empty($this->request->data['pseudo']) || empty($this->request->data['password']))
            return $this->sendJSON(['statut' => false, 'msg' => $this->Lang->get('ERROR__FILL_ALL_FIELDS')]);
        $this->autoRender = false;
        $this->response->type('json');
        $this->loadModel('Authentification');
        $this->loadModel('User');
        $this->request->data = $this->request->data['xss'];
        $user_login = $this->User->getAllFromUser($this->request->data['pseudo']);
        $infos = $this->Authentification->find('first', ['conditions' => ['user_id' => $user_login['id'], 'enabled' => true]]);

        $confirmEmailIsNeeded = ($this->Configuration->getKey('confirm_mail_signup') && $this->Configuration->getKey('confirm_mail_signup_block'));
        $login = $this->User->login($user_login, $this->request->data, $confirmEmailIsNeeded, $this->Configuration->getKey('check_uuid'), $this);
        if (!isset($login['status']) || $login['status'] !== true) {
            return $this->sendJSON([
                'statut' => false,
                'msg' => $this->Lang->get($login, ['{URL_RESEND_EMAIL}' => Router::url(['action' => 'resend_confirmation'])])
            ]);
        }

        $event = new CakeEvent('onLogin', $this, ['user' => $user_login]);
        $this->getEventManager()->dispatch($event);
        if ($event->isStopped())
            return $event->result;
        if ($infos) {
            $this->Session->write('user_id_two_factor_auth', $user_login['id']);
            $this->sendJSON([
                'statut' => true,
                'msg' => $this->Lang->get('USER__REGISTER_LOGIN'),
                'two-factor-auth' => true
            ]);
        } else {
            if ($this->request->data['remember_me']) {
                $this->Cookie->write('remember_me', [
                    'pseudo' => $this->request->data['pseudo'],
                    'password' => $this->User->getFromUser('password', $this->request->data['pseudo'])
                ], true, '1 week');
            }
            $this->Session->write('user', $login['session']);
            $this->sendJSON(['statut' => true, 'msg' => $this->Lang->get('USER__REGISTER_LOGIN')]);
        }

    }

    function confirm($code = false)
    {
        $this->autoRender = false;
        if (isset($code)) {
            $find = $this->User->find('first', ['conditions' => ['confirmed' => $code]]);
            if (!empty($find)) {
                $event = new CakeEvent('beforeConfirmAccount', $this, ['user_id' => $find['User']['id']]);
                $this->getEventManager()->dispatch($event);
                if ($event->isStopped()) {
                    return $event->result;
                }
                $this->User->read(null, $find['User']['id']);
                $this->User->set(['confirmed' => date('Y-m-d H:i:s')]);
                $this->User->save();
                $userSession = $find['User']['id'];
                $this->loadModel('Notification');
                $this->Notification->setToUser($this->Lang->get('USER__CONFIRM_NOTIFICATION'), $find['User']['id']);
                $this->Session->write('user', $userSession);
                $event = new CakeEvent('onLogin', $this, ['user' => $this->User->getAllFromCurrentUser(), 'confirmAccount' => true]);
                $this->getEventManager()->dispatch($event);
                if ($event->isStopped()) {
                    return $event->result;
                }
                $this->redirect(['action' => 'profile']);
            } else {
                throw new NotFoundException();
            }
        } else {
            throw new NotFoundException();
        }
    }

    function logout()
    {
        $this->autoRender = false;
        $event = new CakeEvent('onLogout', $this, ['session' => $this->Session->read('user')]);
        $this->getEventManager()->dispatch($event);
        if ($event->isStopped()) {
            return $event->result;
        }
        if ($this->Cookie->read('remember_me')) {
            $this->Cookie->delete('remember_me');
        }
        $this->Session->delete('user');
        $this->redirect($this->referer());
    }
}
