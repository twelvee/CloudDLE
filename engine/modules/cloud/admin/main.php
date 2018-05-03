<?php
define("ADMINDIR", __DIR__);

require ADMINDIR . '/config/config.php';
require ADMINDIR . '/routing/bootstrap.php';

use Routing\Router;
use Routing\MatchedRoute;

try {
	
    $router = new Router(GET_HTTP_HOST()."/".$config['admin_path']."?mod=cloud");
    $router->add('main', '/', 'AdminController:mainAction');
    $router->add('modules', '&action=modules', 'ModulesController:mainAction');
    $router->add('CRUD', '&action=crud', 'CrudController:mainAction');
    $router->add('composer', '&action=composer', 'ComposerController:mainAction', 'GET|POST');
    $router->add('settings', '&action=settings', 'AdminController:settingsAction');
    $router->add('composer_ajax', '&action=composer&ajaxaccepter', 'ComposerController:ajaxAction', 'POST');
    /*
    $router->add('about', '/about', 'AppController:aboutAction');
    $router->add('contacts', '/contacts', 'AppController:contactsAction');
    $router->add('user', '/user/(id:num)', 'AppController:userAction');
	*/
    $route = $router->match(GET_METHOD(), GET_PATH_INFO());

    if (null == $route) {
        $route = new MatchedRoute('AdminController:error404Action');
    }

    list($class, $action) = explode(':', $route->getController(), 2);

    call_user_func_array(array(new $class($router), $action), $route->getParameters());


} catch (Exception $e) {

    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);

    echo $e->getMessage();
    echo $e->getTraceAsString();
    exit;
}