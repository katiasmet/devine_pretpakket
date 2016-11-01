<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('WWW_ROOT', __DIR__ . DS); 

$routes = array(
    'home' => array( 
    	'controller' => 'Packages', 
    	'action' => 'index' 
    ),
    'pakketten' => array( 
    	'controller' => 'Packages', 
    	'action' => 'overview' 
    ),
    'pakket_detail' => array( 
    	'controller' => 'Packages', 
    	'action' => 'detail' 
    ),
    'pretinjouwbuurt' => array( 
    	'controller' => 'Packages', 
    	'action' => 'neighbourhood' 
    ),
    'search' => array(
        'controller' => 'Packages',
        'action' => 'search'
    ),
    'workshops' => array( 
    	'controller' => 'Workshops', 
    	'action' => 'overview' 
    ),
    'workshop_detail' => array( 
    	'controller' => 'Workshops', 
    	'action' => 'detail' 
    ),
    'login' => array(
        'controller' => 'Users',
        'action' => 'login'
    ),
    'logout' => array(
        'controller' => 'Users',
        'action' => 'logout'
    ),
    'registreren' => array(
        'controller' => 'Users',
        'action' => 'register'
    ),
    'wijzig' => array(
        'controller' => 'Users',
        'action' => 'edit'
    ),
    'newsletter' => array(
        'controller' => 'Users',
        'action' => 'newsletter'
    ),
    'mijnprofiel' => array(
        'controller' => 'Users',
        'action' => 'account'
    ),
    'winkelwagen' => array(
        'controller' => 'Orders',
        'action' => 'cart'
    ),
    'add-package' => array(
        'controller' => 'Orders',
        'action' => 'add_package'
    ),
    'bestellen' => array(
        'controller' => 'Orders',
        'action' => 'place_order'
    )
    
);

if(empty($_GET['page'])) {
    $_GET['page'] = 'home';
}
if(empty($routes[$_GET['page']])) {
    header('Location: index.php');
    exit();
}

$route = $routes[$_GET['page']];
$controllerName = $route['controller'] . 'Controller';

require_once WWW_ROOT . 'controller' . DS . $controllerName . ".php";

$controllerObj = new $controllerName();
$controllerObj->route = $route;
$controllerObj->filter();
$controllerObj->render();