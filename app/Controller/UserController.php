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

    function admin_index()
    {
        if ($this->isConnected and $this->Permissions->can('MANAGE_USERS')) {
            $this->set('title_for_layout', $this->Lang->get('USER__TITLE'));
            $this->layout = 'admin';
            $this->set('type', $this->Configuration->getKey('member_page_type'));
        } else {
            $this->redirect('/');
        }
    }

    function admin_liveSearch($query = false)
    {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->isConnected and $this->Permissions->can('MANAGE_USERS')) {
            if ($query != false) {
                $result = $this->User->find('all', ['conditions' => ['pseudo LIKE' => $query . '%']]);
                $users = [];
                foreach ($result as $value) {
                    $users[] = ['pseudo' => $value['User']['pseudo'], 'id' => $value['User']['id']];
                }
                $response = (empty($result)) ? ['status' => false] : ['status' => true, 'data' => $users];
                $this->response->body($response);
            } else {
                $this->response->body(json_encode(['status' => false]));
            }
        } else {
            $this->response->body(json_encode(['status' => false]));
        }
    }

    public function admin_get_users()
    {
        if ($this->isConnected and $this->Permissions->can('MANAGE_USERS')) {
            $this->autoRender = false;
            $this->response->type('json');
            if ($this->request->is('ajax')) {
                $available_ranks = [
                    0 => ['label' => 'success', 'name' => $this->Lang->get('USER__RANK_MEMBER')],
                    2 => ['label' => 'warning', 'name' => $this->Lang->get('USER__RANK_MODERATOR')],
                    3 => ['label' => 'danger', 'name' => $this->Lang->get('USER__RANK_ADMINISTRATOR')],
                    4 => ['label' => 'danger', 'name' => $this->Lang->get('USER__RANK_ADMINISTRATOR')]
                ];
                $this->loadModel('Rank');
                $custom_ranks = $this->Rank->find('all');
                foreach ($custom_ranks as $value) {
                    $available_ranks[$value['Rank']['rank_id']] = [
                        'label' => 'info',
                        'name' => $value['Rank']['name']
                    ];
                }
                $this->DataTable = $this->Components->load('DataTable');
                $this->modelClass = 'User';
                $this->DataTable->initialize($this);
                $this->paginate = [
                    'fields' => ['User.id', 'User.pseudo', 'User.email', 'User.created', 'User.rank'],
                ];
                $this->DataTable->mDataProp = true;
                $response = $this->DataTable->getResponse();
                $users = $response['aaData'];
                $data = [];
                foreach ($users as $value) {
                    $username = $value['User']['pseudo'];
                    $date = 'Le ' . $this->Lang->date($value['User']['created']);
                    $rank_label = (isset($available_ranks[$value['User']['rank']])) ? $available_ranks[$value['User']['rank']]['label'] : $available_ranks[0]['label'];
                    $rank_name = (isset($available_ranks[$value['User']['rank']])) ? $available_ranks[$value['User']['rank']]['name'] : $available_ranks[0]['name'];
                    $rank = '<span class="label label-' . $rank_label . '">' . $rank_name . '</span>';
                    $btns = '<a href="' . Router::url([
                            'controller' => 'user',
                            'action' => 'edit/' . $value["User"]["id"],
                            'admin' => true
                        ]) . '" class="btn btn-info">' . $this->Lang->get('GLOBAL__EDIT') . '</a>';
                    $btns .= '&nbsp;<a onClick="confirmDel(\'' . Router::url([
                            'controller' => 'user',
                            'action' => 'delete/' . $value["User"]["id"],
                            'admin' => true
                        ]) . '\')" class="btn btn-danger">' . $this->Lang->get('GLOBAL__DELETE') . '</button>';
                    $data[] = [
                        'User' => [
                            'pseudo' => $username,
                            'email' => $value['User']['email'],
                            'created' => $date,
                            'rank' => $rank
                        ],
                        'actions' => $btns
                    ];
                }
                $response['aaData'] = $data;
                $this->response->body(json_encode($response));
            }
        }
    }

    function admin_edit($search = false)
    {
        if ($this->isConnected and $this->Permissions->can('MANAGE_USERS')) {
            if ($search != false) {
                $this->layout = 'admin';
                $this->set('title_for_layout', $this->Lang->get('USER__EDIT_TITLE'));
                $this->loadModel('User');
                $find = $this->User->find('all', ['conditions' => $this->User->__makeCondition($search)]);
                if (!empty($find)) {
                    $search_user = $find[0]['User'];
                    $this->loadModel('History');
                    $findHistory = $this->History->getLastFromUser($search_user['id']);
                    $search_user['History'] = $this->History->format($findHistory, $this->Lang);
                    $options_ranks = [
                        0 => $this->Lang->get('USER__RANK_MEMBER'),
                        2 => $this->Lang->get('USER__RANK_MODERATOR'),
                        3 => $this->Lang->get('USER__RANK_ADMINISTRATOR'),
                        4 => $this->Lang->get('USER__RANK_SUPER_ADMINISTRATOR')
                    ];
                    $this->loadModel('Rank');
                    $custom_ranks = $this->Rank->find('all');
                    foreach ($custom_ranks as $key => $value) {
                        $options_ranks[$value['Rank']['rank_id']] = $value['Rank']['name'];
                    }
                    if ($this->Configuration->getKey('confirm_mail_signup') && !empty($search_user['confirmed']) && date('Y-m-d H:i:s', strtotime($search_user['confirmed'])) != $search_user['confirmed']) {
                        $search_user['confirmed'] = false;
                    } else {
                        $search_user['confirmed'] = true;
                    }
                    $this->set(compact('options_ranks'));
                    $this->set(compact('search_user'));
                } else {
                    throw new NotFoundException();
                }
            } else {
                throw new NotFoundException();
            }
        } else {
            $this->redirect('/');
        }
    }

    function admin_confirm($user_id = false)
    {
        $this->autoRender = false;
        if (isset($user_id) && $this->isConnected and $this->Permissions->can('MANAGE_USERS')) {
            $find = $this->User->find('first', ['conditions' => ['id' => $user_id]]);
            if (!empty($find)) {
                $event = new CakeEvent('beforeConfirmAccount', $this, ['user_id' => $find['User']['id'], 'manual' => true]);
                $this->getEventManager()->dispatch($event);
                if ($event->isStopped()) {
                    return $event->result;
                }
                $this->User->read(null, $find['User']['id']);
                $this->User->set(['confirmed' => date('Y-m-d H:i:s')]);
                $this->User->save();
                $this->redirect(['action' => 'edit', $user_id]);
            } else {
                throw new NotFoundException();
            }
        } else {
            throw new NotFoundException();
        }
    }

    function admin_edit_ajax()
    {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->isConnected && $this->Permissions->can('MANAGE_USERS')) {
            if ($this->request->is('post')) {
                $this->loadModel('User');
                if (!empty($this->request->data['id']) && !empty($this->request->data['email']) && !empty($this->request->data['pseudo']) && (!empty($this->request->data['rank']) || $this->request->data['rank'] == 0)) {
                    $this->request->data = $this->request->data['xss'];
                    $findUser = $this->User->find('first',
                        ['conditions' => ['id' => intval($this->request->data['id'])]]);
                    if (empty($findUser)) {
                        $this->response->body(json_encode([
                            'statut' => false,
                            'msg' => $this->Lang->get('USER__EDIT_ERROR_UNKNOWN')
                        ]));
                        return;
                    }
                    if ($findUser['User']['id'] == $this->User->getKey('id') && $this->request->data['rank'] != $this->User->getKey('rank')) {
                        $this->response->body(json_encode([
                            'statut' => false,
                            'msg' => $this->Lang->get('USER__EDIT_ERROR_YOURSELF')
                        ]));
                        return;
                    }
                    $data = [
                        'email' => $this->request->data['email'],
                        'rank' => $this->request->data['rank'],
                        'pseudo' => $this->request->data['pseudo'],
                        'uuid' => $this->request->data['uuid']
                    ];

                    if (!empty($this->request->data['password'])) {
                        $data['password'] = $this->Util->password($this->request->data['password'], $findUser['User']['pseudo']);
                        $password_updated = true;
                    } else {
                        $password_updated = false;
                    }
                    if ($this->EyPlugin->isInstalled('eywek.shop')) {
                        $data['money'] = $this->request->data['money'];
                    }
                    $event = new CakeEvent('beforeEditUser', $this, [
                        'user_id' => $findUser['User']['id'],
                        'data' => $data,
                        'password_updated' => $password_updated
                    ]);
                    $this->getEventManager()->dispatch($event);
                    if ($event->isStopped()) {
                        return $event->result;
                    }
                    $this->User->read(null, $findUser['User']['id']);
                    $this->User->set($data);
                    $this->User->save();
                    $this->History->set('EDIT_USER', 'user');
                    $this->Session->setFlash($this->Lang->get('USER__EDIT_SUCCESS'), 'default.success');
                    $this->response->body(json_encode([
                        'statut' => true,
                        'msg' => $this->Lang->get('USER__EDIT_SUCCESS')
                    ]));
                } else {
                    $this->response->body(json_encode([
                        'statut' => false,
                        'msg' => $this->Lang->get('ERROR__FILL_ALL_FIELDS')
                    ]));
                }
            } else {
                throw new NotFoundException();
            }
        } else {
            throw new ForbiddenException();
        }
    }

    function admin_delete($id = false)
    {
        $this->autoRender = false;
        if ($this->isConnected and $this->Permissions->can('MANAGE_USERS')) {
            if ($id != false) {
                $this->loadModel('User');
                $find = $this->User->find('all', ['conditions' => ['id' => $id]]);
                if (!empty($find)) {
                    $event = new CakeEvent('beforeDeleteUser', $this, ['user' => $find['User']]);
                    $this->getEventManager()->dispatch($event);
                    if ($event->isStopped()) {
                        return $event->result;
                    }
                    $this->User->delete($id);
                    $this->History->set('DELETE_USER', 'user');
                    $this->Session->setFlash($this->Lang->get('USER__DELETE_SUCCESS'), 'default.success');
                } else {
                    $this->Session->setFlash($this->Lang->get('UNKNONW_ID'), 'default.error');
                }
            }
            $this->redirect(['controller' => 'user', 'action' => 'index', 'admin' => true]);
        } else {
            $this->redirect('/');
        }
    }
}
