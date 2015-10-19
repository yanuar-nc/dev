<?php

    class NotificationsController extends AppController
    {
        
        public $model_name      = 'Notification';
        public $module_title    = 'Notification';
        public $module_desc     = ''; 
        public $module_icon     = 'fa fa-bell-o';       
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

            $text_notification = $this->Notification->getTextNotification();
            $this->set( compact( 'var_model', 'module_title', 'module_desc', 'title_for_layout', 'module_icon', 'text_notification' ) );            

            $this->Auth->allow( 'checkInboxMessage');
        }

        public function admin_lists( $id = null )
        {

            $this->autoRender = false;
            $options[ 'conditions' ] = array( 'Notification.status' => 0, 'Notification.role' => 'admin' );
            if ( $id > 0 )
            {
                $options[ 'conditions' ] = array( 'Notification.status' => 0, 'Notification.role' => 'admin', 'Notification.id > ' . $id );
            }

            $datas = $this->Notification->find( 'all', $options );
            $text_notification = $this->Notification->getTextNotification();
            if ( count( $datas ) > 0 ):
                foreach ( $datas as $key => $data ) {

                    $row    = $data[ 'Notification' ];
                    $leader = $data[ 'Leader' ];

                    $from   = $leader[ 'name' ];
                    $time   = time_ago( $row[ 'created' ] );
                    $text   = $text_notification[ $row[ 'action' ] ] . " " . $text_notification[ $row[ 'content' ] ];
                    $redirect = Router::url( array( 'controller' => $row[ 'content' ], 'action' => $row[ 'redirect' ], $row[ 'content_id' ] ), true );

                    $merge  = array( 'from' => $from, 'text' => $text, 'redirect' => $redirect, 'time' => $time );
                    $datas[ $key ][ 'Notification' ] = array_merge( $row, $merge );
                }
                $this->response->type('json');
                $json  = json_encode( $datas );
                $this->response->body($json);
            else:
                $this->response->body( json_encode( array() ) );
            endif;
        }


        public function admin_index()
        {
            $options[ 'order' ]      = array( 'Notification.id' => 'DESC' );
            $this->Paginator->settings = $options;
            $datas = $this->Paginator->paginate( $this->model_name );

            //$datas = $this->MailInbox->find( 'all', $options );
            $this->set( compact( 'datas' ) );              
        }

        public function leader_lists( $id = null )
        {

            $this->autoRender = false;
            $options[ 'conditions' ] = array( 'Notification.status' => 0, 'Notification.role' => 'leader' );
            if ( $id > 0 )
            {
                $options[ 'conditions' ] = array( 'Notification.status' => 0, 'Notification.role' => 'leader', 'Notification.id > ' . $id );
            }

            $datas = $this->Notification->find( 'all', $options );
            $text_notification = $this->Notification->getTextNotification();
            if ( count( $datas ) > 0 ):
                foreach ( $datas as $key => $data ) {

                    $row    = $data[ 'Notification' ];
                    $leader = $data[ 'Leader' ];

                    $from   = $leader[ 'name' ];
                    $time   = time_ago( $row[ 'created' ] );
                    $text   = $text_notification[ $row[ 'action' ] ] . " " . $text_notification[ $row[ 'content' ] ];
                    $redirect = Router::url( array( 'controller' => $row[ 'content' ], 'action' => $row[ 'redirect' ], $row[ 'content_id' ] ), true );

                    $merge  = array( 'from' => $from, 'text' => $text, 'redirect' => $redirect, 'time' => $time );
                    $datas[ $key ][ 'Notification' ] = array_merge( $row, $merge );
                }
                $this->response->type('json');
                $json  = json_encode( $datas );
                $this->response->body($json);
            else:
                $this->response->body( json_encode( array() ) );
            endif;
        }
    }

?>