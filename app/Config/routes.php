<?php

if (file_exists(ROOT . '/config/installed.txt') and file_exists(ROOT . '/config/install.txt')) {

    Router::connect('/', ['controller' => 'pages', 'action' => 'display', 'home']);
    Router::connect('/theme', ['controller' => 'theme', 'action' => 'selectTheme']);

    Router::connect('/robots.txt', ['controller' => 'pages', 'action' => 'robots']);

    Router::connect('/pages/*', ['controller' => 'pages', 'action' => 'display']);

    Router::connect('/blog', ['controller' => 'news', 'action' => 'blog']);
    Router::connect('/blog/*', ['controller' => 'news', 'action' => 'index']);
    Router::connect('/blog/', ['controller' => 'news', 'action' => 'blog']);

    Router::connect('/p/*', ['controller' => 'pages', 'action' => 'index']);

    Router::connect('/maintenance/**', ['controller' => 'maintenance', 'action' => 'index']);

    // Admin
    Configure::write('Routing.prefixes', ['admin']);
    Router::connect(
        '/admin',
        ['controller' => 'admin', 'action' => 'index', 'prefix' => 'admin']
    );
    Configure::write('Routing.admin', 'admin');

} else {

    // if not install
    Router::connect('/', ['controller' => 'install', 'action' => 'index']);

}

// End
CakePlugin::routes();

require CAKE . 'Config' . DS . 'routes.php';
