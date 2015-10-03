<?php

    class OutboxLeadersController extends AppController
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
            $this->Auth->allow( 'checkOutboxMessage');
        }

        public function checkOutboxMessage()
        {

            $this->autoRender = false;
            $q = $this->OutboxLeader->find( 'count', array( 'conditions' => array( 'OutboxLeader.leader_id' => $this->auth_leader_id, 'OutboxLeader.status' => 0 ) ) );
            //$this->set( compact( 'q' ) );
            if ( $q > 0 )
            return $q;
            //$this->render( '/Home/assistant_index' );
        }

    }

?>