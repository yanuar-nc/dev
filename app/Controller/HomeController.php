<?php

    class HomeController extends AppController
    {
        
        public $model_name      = 'Home';
        public $module_title    = 'Home';
        public $module_desc     = ''; 
        public $module_icon     = 'fa fa-home';       
        public function beforeFilter()
        {
            /*
            $this->loadModel( 'Post' );
            */
            parent::beforeFilter();
            $var_model      = $this->model_name;
            $module_title   = $this->module_title;
            $module_desc    = $this->module_title;
            $module_icon    = $this->module_icon;
            $title_for_layout = $module_title;
            $this->set( compact( 'var_model', 'module_title', 'module_desc', 'title_for_layout', 'module_icon' ) );            
            
        }
        
        public function index()
        {
            return $this->redirect( array( 'controller' => 'home', 'action' => 'index', $this->auth_role => true ) );
        }

        public function admin_index()
        {
            
        }

        public function leader_index()
        {

        }
        
        public function assistant_index()
        {

        }

        public function unit_index()
        {
            
        }
    }

?>