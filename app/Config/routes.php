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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	//Router::parseExtensions();
	//Router::setExtensions(array('pdf'));
  
    Router::connect('/',            array('controller' => 'home', 'action' => 'index', 'home', 'admin' => false));
    Router::connect('/admin',       array('controller' => 'home', 'action' => 'index', 'home', 'admin' => true));
    Router::connect('/leader',      array('controller' => 'home', 'action' => 'index', 'home', 'leader' => true));
    Router::connect('/assistant',   array('controller' => 'home', 'action' => 'index', 'home', 'assistant' => true));
    Router::connect('/unit',        array('controller' => 'home', 'action' => 'index', 'home', 'unit' => true));

    Router::connect( '/login', array( 'controller' => 'users', 'action' => 'login', 'admin' => false ) );
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
/**/

Router::connect('/:language/:controller/:action/*',
                   array(),
                   array('language' => '[a-z]{3}'));
Router::connect('/:language/:controller/:action/*',
                    array(),
                    array('language' => 'eng|ind'));

Router::connect('/:language/:controller',
                    array('action' => 'index'),
                    array('language' => 'eng|ind'));	


Router::connect('/:language',
                    array('controller' => 'home', 'action' => 'index', 'admin' => false ),
                    array('language' => 'eng|ind'));
Router::connect('/admin/:language',
                    array('controller' => 'home', 'action' => 'index', 'admin' => true ),
                    array('language' => 'eng|ind'));
	
Router::connect( '/:slug.html',  
    array( 'controller' => 'products', 'action' => 'child_category' ), 
    array( 'pass' => array( 'slug' ) ) 
);

Router::connect( '/page/:slug',
    array( 'controller' => 'pages', 'action' => 'view' ), 
    array( 'pass' => array( 'slug' ) )     
);

Router::parseExtensions('json');
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
