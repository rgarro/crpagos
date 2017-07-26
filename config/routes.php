<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    //$routes->connect('/', ['controller' => 'Pages', 'action' => 'index', 'home']);
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'login']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});


/******/
Router::connect('/clients/:action/:id',  array('controller' => 'clients', 'action' => 'index'), array('pass' => array('id'), 0) );
Router::connect('/users/:action/:id',  array('controller' => 'users', 'action' => 'index'), array('pass' => array('id'), 0) );
Router::connect('/myaccount/:action/:id',  array('controller' => 'myaccount', 'action' => 'index'), array('pass' => array('id'), 0) );
Router::connect('/mycompany/:action/:id',  array('controller' => 'mycompany', 'action' => 'index'));

Router::connect('/code/',  array('controller' => 'pages', 'action' => 'display', 'code'));
Router::connect('/codigo/',  array('controller' => 'pages', 'action' => 'display', 'code'));

Router::connect('/terms/',  array('controller' => 'pages', 'action' => 'terms'));
/********/

Router::connect('/contactus/',  array('controller' => 'contactus', 'action' => 'index'));
Router::connect('/contactenos/',  array('controller' => 'contactus', 'action' => 'index'));
Router::connect('/login/',  array('controller' => 'login', 'action' => 'index'));

/*******/
$controller = '/pragmatico';
Router::connect($controller.'/codigo-de-solicitud/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/invoice-code/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/:action/:id',array('controller' => 'company', 'action' => 'index', $controller),array('pass' => array('id'), 1));
Router::connect($controller,array('controller' => 'response', 'action' => 'index'));
$controller = '/pragmasoft';
Router::connect($controller.'/codigo-de-solicitud/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/invoice-code/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/:action/:id',array('controller' => 'company', 'action' => 'index', $controller),array('pass' => array('id'), 1));
Router::connect($controller,array('controller' => 'response', 'action' => 'index'));
$controller = '/crmotos';
Router::connect($controller.'/codigo-de-solicitud/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/invoice-code/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/:action/:id',array('controller' => 'company', 'action' => 'index', $controller),array('pass' => array('id'), 1));
Router::connect($controller,array('controller' => 'response', 'action' => 'index'));
$controller = '/tachiztravel';
Router::connect($controller.'/codigo-de-solicitud/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/invoice-code/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/:action/:id',array('controller' => 'company', 'action' => 'index', $controller),array('pass' => array('id'), 1));
Router::connect($controller,array('controller' => 'response', 'action' => 'index'));
$controller = '/hotelaeropuerto';
Router::connect($controller.'/codigo-de-solicitud/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/invoice-code/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/:action/:id',array('controller' => 'company', 'action' => 'index', $controller),array('pass' => array('id'), 1));
Router::connect($controller,array('controller' => 'response', 'action' => 'index'));
$controller = '/intercontinental';
Router::connect($controller.'/codigo-de-solicitud/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/invoice-code/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/:action/:id',array('controller' => 'company', 'action' => 'index', $controller),array('pass' => array('id'), 1));
Router::connect($controller,array('controller' => 'response', 'action' => 'index'));
$controller = '/hampton';
Router::connect($controller.'/codigo-de-solicitud/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/invoice-code/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/:action/:id',array('controller' => 'company', 'action' => 'index', $controller),array('pass' => array('id'), 1));
Router::connect($controller,array('controller' => 'response', 'action' => 'index'));
$controller = '/hiex';
Router::connect($controller.'/codigo-de-solicitud/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/invoice-code/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/:action/:id',array('controller' => 'company', 'action' => 'index', $controller),array('pass' => array('id'), 1));
Router::connect($controller,array('controller' => 'response', 'action' => 'index'));
$controller = '/crst';
Router::connect($controller.'/codigo-de-solicitud/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/invoice-code/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/:action/:id',array('controller' => 'company', 'action' => 'index', $controller),array('pass' => array('id'), 1));
Router::connect($controller,array('controller' => 'response', 'action' => 'index'));
$controller = '/hotelsanjose';
Router::connect($controller.'/codigo-de-solicitud/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/invoice-code/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/:action/:id',array('controller' => 'company', 'action' => 'index', $controller),array('pass' => array('id'), 1));
Router::connect($controller,array('controller' => 'response', 'action' => 'index'));
$controller = '/hotelirazu';
Router::connect($controller.'/codigo-de-solicitud/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/invoice-code/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/:action/:id',array('controller' => 'company', 'action' => 'index', $controller),array('pass' => array('id'), 1));
Router::connect($controller,array('controller' => 'response', 'action' => 'index'));
$controller = '/hoteljaco';
Router::connect($controller.'/codigo-de-solicitud/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/invoice-code/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/:action/:id',array('controller' => 'company', 'action' => 'index', $controller),array('pass' => array('id'), 1));
Router::connect($controller,array('controller' => 'response', 'action' => 'index'));
$controller = '/grayline';
Router::connect($controller.'/codigo-de-solicitud/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/invoice-code/',array('controller' => 'code', 'action' => 'index', $controller));
Router::connect($controller.'/:action/:id',array('controller' => 'company', 'action' => 'index', $controller),array('pass' => array('id'), 1));
Router::connect($controller,array('controller' => 'response', 'action' => 'index'));
/*******/

if(stristr($_SERVER['REQUEST_URI'], '.htm') === FALSE) {

    /***********/
    /*$companies = ["pragmatico","pragmasoft","crmotos","tachiztravel","hotelaeropuerto","intercontinental","hampton","hiex","crst","hotelsanjose","hotelirazu","hoteljaco","grayline"];
    $parts = explode("/",$_SERVER['REQUEST_URI']);
    $controller = $parts[1];
    $company_found = in_array($controller, $companies);
    $isAjax = false;

echo $controller;
exit;*/

    /*if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $isAjax = true;
    }

    if($company_found){

      if(strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' || isset($isAjax)){

      }else{

      }
    }else{
      Router::connect($_SERVER['REQUEST_URI'], array('controller' => 'pages', 'action' => 'display', 'code'));
    }*/
    /************/
}else{
  $TheName =  basename(strtolower($_SERVER['REQUEST_URI']), ".htm");
  $TheName = (stristr($TheName, '?') === FALSE? $TheName : array_shift((explode("?",$TheName))));//aqui se gano el dolar del dia
  $TheName =  basename(strtolower($TheName), ".htm");
  Router::connect('/'.$TheName.'.htm', array('controller' => 'pages', 'action' => 'display', $TheName));
}

Plugin::routes();
