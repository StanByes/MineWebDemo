<?php

class APIController extends AppController
{

    public $components = ['Session', 'API'];

    public function get_skin($name)
    {
        header('Content-Type: image/png');
        $this->autoRender = false;
        echo $this->API->get_skin($name);
    }

    public function get_head_skin($name, $size = 50)
    {
        header('Content-Type: image/png');
        $this->autoRender = false;
        echo $this->API->get_head_skin($name, $size);
    }

}
