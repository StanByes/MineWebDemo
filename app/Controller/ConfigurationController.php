<?php

class ConfigurationController extends AppController
{

    public $components = ['Session', 'RequestHandler', 'Util'];

    public function admin_index()
    {
        if ($this->isConnected and $this->Permissions->can('MANAGE_CONFIGURATION')) {
            $this->layout = "admin";

            $data = [];

            if ($this->request->is('post')) {
                foreach ($this->request->data as $key => $value) {
                    if ($key != "version") {
                        if ($key == "banner_server") {
                            $value = serialize($value);
                        }
                        $data[$key] = $value;
                    }
                }

                $this->loadModel('User');
                $hash = $this->Configuration->getKey('passwords_hash');
                $this->User->updateAll(
                    ['password_hash' => "'$hash'"],
                    ['password_hash' => null]
                );

                $data['end_layout_code'] = $data['xss']['end_layout_code'];

                $this->Configuration->read(null, 1);
                $this->Configuration->set($data);
                $this->Configuration->save();

                $this->History->set('EDIT_CONFIGURATION', 'configuration');

                $this->Configuration->cacheQueries = false; //On désactive le cache
                $this->Configuration->dataConfig = null;
                $this->Lang->lang = $this->Lang->getLang(); // on refresh les messages

                $this->Session->setFlash($this->Lang->get('CONFIG__EDIT_SUCCESS'), 'default.success');
            }

            $config = $this->Configuration->getAll();

            $this->Configuration->cacheQueries = true; //On le réactive

            $config['lang'] = $this->Lang->getLang('config')['path'];

            foreach ($this->Lang->languages as $key => $value) {
                $config['languages_available'][$key] = $value['name'];
            }

            $this->set('config', $config);

            $this->set('shopIsInstalled', $this->EyPlugin->isInstalled('eywek.shop'));

        } else {
            $this->redirect('/');
        }
    }

    public function admin_editLang()
    {
        if ($this->isConnected and $this->Permissions->can('MANAGE_CONFIGURATION')) {

            $this->layout = 'admin';

            if ($this->request->is('post')) {

                if (stripos($this->request->data['GLOBAL__FOOTER'], '<a href="http://mineweb.org">mineweb.org</a>') === false) {
                    $this->Session->setFlash($this->Lang->get('CONFIG__ERROR_SAVE_LANG'), 'default.error');
                } else {

                    $this->Lang->setAll($this->request->data);

                    $this->History->set('EDIT_LANG', 'lang');

                    $this->Session->setFlash($this->Lang->get('CONFIG__EDIT_LANG_SUCCESS'), 'default.success');

                }
            }

            $this->Lang->lang = $this->Lang->getLang(); // on refresh les messages

            $this->set('messages', $this->Lang->lang['messages']);
            $this->set('title_for_layout', $this->Lang->get('CONFIG__LANG_LABEL'));

        } else {
            $this->redirect('/');
        }
    }

}
