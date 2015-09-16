<?php

    class LeaderMailsController extends AppController
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
            $this->Auth->allow( 'checkInboxMessage');
        }

        public function assistant_checkInboxMessage()
        {

            $this->autoRender = false;
            $q = $this->LeaderMail->find( 'count', array( 'conditions' => array( 'LeaderMail.leader_id' => $this->auth_leader_id, 'LeaderMail.status' => 0 ) ) );
            //$this->set( compact( 'q' ) );
            if ( $q > 0 )
            return $q;
            //$this->render( '/Home/assistant_index' );
        }

        public function checkInboxMessage()
        {

            $this->autoRender = false;
            $q = $this->LeaderMail->find( 'count', array( 'conditions' => array( 'LeaderMail.leader_id' => $this->auth_leader_id, 'LeaderMail.status' => 0 ) ) );
            //$this->set( compact( 'q' ) );
            if ( $q > 0 )
            return $q;
            //$this->render( '/Home/assistant_index' );
        }

    }

?>