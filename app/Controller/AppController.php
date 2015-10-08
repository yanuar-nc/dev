<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller 
{
    
    const DEFAULT_LANGUAGE = 'eng';
    public $components = array( 
        'DebugKit.Toolbar',
        'Paginator',
        'Session',
        'Cookie',
        'Auth'  => array(
            'loginRedirect' => array(
                'controller' => 'home',
                'action' => 'index',
                'leader' => false,
                'assistant' => false,
                'admin' => false,
                'unit' => false
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login',
                'leader' => false,
                'assistant' => false,
                'admin' => false,
                'unit' => false
                
            ),  
            'authorize' => array( 'Controller' ),
            'authenticate' => array(
                'Form' => array(
                    'scope' => array( 'User.status' => 0)
                )
            )
        )
    );

    public $page_types     = array( 
                                 'About Me' => 'About Us', 
                                 'FAQ' => 'FAQ', 
                                 'Privacy Policy' => 'Privacy Policy', 
                                 'Career' => 'Career', 
                                 'Terms and Conditions' => 'Terms and Condition',
                                 'Health Info' => 'Health Info',
                                 'Copyright Statement' => 'Copyright Statement',
                                 'Site Map' => 'Site Map'
                                 );

    public $auth_role       = null;
    public $auth_leader_id  = null;
    public $auth_id         = null;

    public $helpers = array( 'Html', 'Form', 'Text', 'Session', 'Paginator', 'Js' );
    
    public function isAuthorized( $user )
    {
        
        if( isset( $this->request->params[ 'admin' ] ) )
        {
            return (bool) ( $user[ 'role' ] == 'admin' );                

        } elseif( isset( $this->request->params[ 'leader' ] ) )
        {
            return (bool) ( $user[ 'role' ] == 'leader' );      

        } elseif( isset( $this->request->params[ 'assistant' ] ) )
        {
            return (bool) ( $user[ 'role' ] == 'assistant' ); 

        } elseif( isset( $this->request->params[ 'unit' ] ) )
        {
            return (bool) ( $user[ 'role' ] == 'unit' );                
        }
        // Default deny
        return false;
        
    }

    public function beforeFilter()
    {
        //$this->data = null;
        // Set Language
        $this->_setLanguage();
        $this->_checkRoute();
        $this->_checkLanguageForFields();

        $this->set( 'lang', $this->Session->read( 'Config.language' ) );

        
        /* Admin Layout */
        //$this->Session->delete( 'Config.language' );
        /*
        if ($this->Session->check( 'Config.language' )) {
            Configure::write('Config.language', $this->Session->read('Config.language'));
        }
        */

        //$this->Session->delete('Config.language' );
        //$this->Cookie->delete( 'lang');

        if( isset( $this->request->params[ 'admin' ] ) )
        {
            $this->theme = 'Admin';
        } elseif( isset( $this->request->params[ 'leader' ] ) ){
            $this->theme = 'Leader';
        } elseif( isset( $this->request->params[ 'assistant' ] ) ){
            $this->theme = 'Assistant';
        } elseif( isset( $this->request->params[ 'unit' ] ) ){
            $this->theme = 'Unit';
        }
        $this->layout = 'default';

        /* Authentication */
        /**/$this->Auth->allow( 
            'login'
        );
        

        if( $this->Auth->loggedIn() )
        {
            $auth_logged_in     = $this->Auth->loggedIn();
            $auth_data          = $this->Auth->user();
            $auth_id            = $this->auth_id = $auth_data[ 'id' ];
            $auth_role          = $this->auth_role = $auth_data[ 'role' ];
            $auth_display_name  = $auth_data[ 'display_name' ];
            $auth_username      = $auth_data[ 'email' ];
            $auth_picture_dir   = '/files/user/picture/' . $auth_id . '/';
            //$auth_picture_dir   = '/files/user/picture/' . $auth_data[ 'picture_dir' ] . '/';
            $auth_picture       = $auth_picture_dir . 'thumb_' . $auth_data[ 'picture' ]; //. $auth_data[ 'picture' ];

            $this->auth_leader_id = $auth_data[ 'leader_id' ];
            //$this->auth_leader_id = $auth_data[ 'leader_id' ];
            
            $this->set(
                compact(
                    'auth_data',
                    'auth_id',
                    'auth_role',
                    'auth_display_name',
                    'auth_username',
                    'auth_picture'
                )
            );
        }
        
        /* Global Variables */
        $var_controller = $this->request->controller;
        $var_action     = $this->action;
        //$statuses       = array( TEXT_ENABLED, TEXT_DISABLED );
        
        $statuses  = array( __( 'Enable' ), __( 'Disable' ) );
        $confirm_statuses = array( __( 'Yes' ), __( 'No' ) );
        $types            = array( __( 'Article' ), __( 'Gallery' ) );
        $gender           = array( 'M' => __( 'Male' ), 'F' => __( 'Female' ) );
        $payment_status = array( __( 'Paid' ), __( 'Un Paid' ) );
        $delivered_status = array( __( 'Delivered' ), __( 'Undelivered') );
        $pending_status   = array( __( 'Delivered' ), __( 'Pending Payment') );
        $confirmed_status   = array( __( 'Unconfirmed' ), __( 'Confirmed' ) );

        $this->set( compact( 
            'var_controller', 
            'var_action', 
            'statuses', 
            'confirm_statuses', 
            'types', 
            'gender', 
            'payment_status', 
            'delivered_status', 
            'confirmed_status',
            'pending_status'
        ) );
        
        
    }
    
    public function _setLanguage() {

        if ($this->Cookie->read('lang') && !$this->Session->check('Config.language')) {
            $this->Session->write('Config.language', $this->Cookie->read('lang'));
        }
        else if (isset($this->params['language']) && ($this->params['language']
                 !=  $this->Session->read('Config.language'))) {

            $this->Session->write('Config.language', $this->params['language']);
            $this->Cookie->write('lang', $this->params['language'], false, '20 days');
        }
    }    
    public function _checkRoute() {
            $params = $this->params['pass'];
            $url = $this->here;

            if (strpos($url, 'language:ind')) {
                $this->Session->write('Config.language', 'ind'); 
                Configure::write('Config.language', 'ind');
            }

            elseif (strpos($url, 'language:eng')) {
                Configure::write('Config.language', 'eng');
                $this->Session->write('Config.language', 'eng');
            }

    }
    
    public function _checkLanguageForFields()
    {

        if( $this->Session->read( 'Config.language' ) == 'eng' ) 
        {
            $this->field_description = 'description'; 
            $this->field_title       = 'title';
        } else {
            $this->field_description = 'description_in_indonesian as description';
            $this->field_title       = 'title_in_indonesian as title';
        } 
               
    }
}
