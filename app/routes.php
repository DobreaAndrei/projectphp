<?php
$routes = [
    '/page/about-us' => ['controller' => 'PageController', 'action' => 'aboutUsAction'],
    '/user/edit' => ['controller' => 'UserController', 'action' => 'userPage', 'guard' => 'Authenticated'],
    '/login' => ['controller' => 'LoginController', 'action' => 'loginPage'],
    '/login/auth' => ['controller' => 'LoginController', 'action' => 'loginAction'],
    '/logout' => ['controller' => 'LoginController', 'action' => 'logoutAction'],
    '/register' => ['controller' => 'LoginController', 'action' => 'registerPage'],
    '/register/reg' => ['controller' => 'LoginController', 'action' => 'registerAction'],
    '/updates' => ['controller' => 'UpdateController', 'action' => 'updatesPage','guard' => 'Authenticated'],
    '/updates/{id}/edit' => ['controller' => 'UpdateController', 'action' => 'editPage','guard' => 'Authenticated'],
    '/updates/{id}/doedit' => ['controller' => 'UpdateController', 'action' => 'editAction','guard' => 'Authenticated'],
    '/updates/{id}/delete' => ['controller' => 'UpdateController', 'action' => 'deleteUpdate','guard' => 'Authenticated'],
    '/updates/{id}/add' => ['controller' => 'UpdateController', 'action' => 'addUpdate','guard' => 'Authenticated'],
    '/' =>['controller' => 'PageController', 'action' => 'home']
];
