<?php

    class MailInboxesController extends AppController
    {
        
        public $model_name      = 'MailInbox';
        public $module_title    = 'Disposisi';
        public $module_desc     = '';
        public $module_icon    = 'fa fa-envelope-o';
        
        public function beforeFilter()
        {
            parent::beforeFilter();
            
            //$this->Auth->allow( 'add', 'logout' );
            
            $var_model      = $this->model_name;
            $module_title   = $this->module_title;
            $module_desc    = $this->module_title;
            $module_icon    = $this->module_icon;
            $readed_status  = array( __( TEXT_READ ), __( TEXT_UNREAD ) );
            $mail_types     = $this->MailInbox->getMailTypes();
            $this->loadModel( 'Leader' );

            $this->set( compact( 'var_model', 'module_title', 'module_desc', 'module_icon', 'readed_status', 'mail_types' ) );
            
            $leader_assistants = $this->Leader->find( 'list', array( 
                'conditions' => array( 'Leader.type' => 2 ),
                'fields' => array( 'Leader.id', 'Leader.name' )
            ) );   

            $leader_units = $this->Leader->find( 'list', array( 
                'conditions' => array( 'Leader.type' => 3 ),
                'fields' => array( 'Leader.id', 'Leader.name' )
            ) );   
            $this->set( compact( 'leader_units', 'leader_assistants' ) );   
        }
        
        public function admin_add()
        {
            if( $this->request->is( 'post' ) )
            {
                $this->MailInbox->create();
                $this->request->data[ 'MailInbox' ][ 'status' ] = 1;
                if( $this->MailInbox->save( $this->request->data ) )
                {
                    $this->Session->setFlash( __( MSG_DATA_UPDATE_SUCCESS ), 'Bootstrap/flash-success' );
                    return $this->redirect( array( 'action' => ACTION_INDEX ) );
                }
                else
                {
                    $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ) );
                }
            }
            
            $leaders = $this->MailInbox->Leader->find( 'list', array( 'conditions' => array( 'type' => 1 ) ) );
            $this->set( compact( 'leaders' ) );
        }

        public function admin_index()
        {
            
            //$this->layout = LAYOUT_ADMIN;
            
            $this->Paginator->settings = array( 'order' => array( 'created' => 'DESC' ) );
            $datas = $this->Paginator->paginate( $this->model_name );
            $this->set( compact( 'datas' ) );
        }
        
        public function admin_read( $id = null )
        {
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->MailInbox->id = $id;
            if( !$this->MailInbox->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            if( $this->MailInbox->updateAll( array( 'status' => 0 ), array( 'id' => $id ) ) )
                 $this->Session->setFlash( __( MSG_DATA_UPDATE_SUCCESS ), 'Bootstrap/flash-success' );
            else $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ) );

            $this->set( 'data', $this->MailInbox->read( null, $id ) );
            //return $this->redirect( array( 'action' => ACTION_INDEX ) );
            
        }
        
        public function admin_unread( $id = null )
        {
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->MailInbox->id = $id;
            if( !$this->MailInbox->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }

            if( $this->MailInbox->updateAll( array( 'status' => 1 ), array( 'id' => $id ) ) )
                 $this->Session->setFlash( __( MSG_DATA_UPDATE_SUCCESS ), 'Bootstrap/flash-success' );
            else $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ) );

            return $this->redirect( array( 'action' => ACTION_INDEX ) );
            
        }        
        public function admin_delete( $id = null )
        {
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->request->onlyAllow( 'post' );
            
            $this->MailInbox->id = $id;
            if( !$this->MailInbox->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            if( $this->MailInbox->delete() )
            {
                $this->Session->setFlash( __( MSG_DATA_DELETE_SUCCESS ), 'Bootstrap/flash-success' );
                return $this->redirect( array( 'action' => ACTION_INDEX ) );
            }
            
            $this->Session->setFlash( __( MSG_DATA_DELETE_FAILED ), 'Bootstrap/flash-error' );
            return $this->redirect( array( 'action' => ACTION_INDEX ) );
        }
        
        public function index()
        {
            
        }
        
        public function add()
        {
            if( $this->request->is( 'post' ) )
            {
                $this->MailInbox->create();
                $this->request->data[ 'MailInbox' ][ 'status' ] = 1;
                if( $this->MailInbox->save( $this->request->data ) )
                {
                    $this->Session->setFlash( __( MSG_DATA_UPDATE_SUCCESS ), 'Bootstrap/flash-success' );
                    return $this->redirect( array( 'action' => ACTION_INDEX ) );
                }
                else
                {
                    $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ) );
                }
            }
        }

        public function leader_edit( $id = null ) 
        {
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->MailInbox->id = $id;
            if( !$this->MailInbox->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            if( $this->request->is( 'post' ) || $this->request->is( 'put' ) )
            {
                foreach( $this->request->data[ 'LeaderMail' ] as $key => $data )
                {
                    if ( $data[ 'leader_id' ] == 0 ) unset( $this->request->data[ 'LeaderMail' ][ $key ] );
                }
                if( $this->MailInbox->saveAssociated( $this->request->data, array( 'deep' => true ) ) )
                {
                    $this->Session->setFlash( __( MSG_DATA_EDIT_SUCCESS ), 'Bootstrap/flash-success' );
                    //return $this->redirect( array( 'action' => ACTION_INDEX ) );
                }
            }
            else
            {
                $this->request->data = $this->MailInbox->read( null, $id );
            }     

        }

        public function assistant_edit( $id = null ) 
        {
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->MailInbox->id = $id;
            if( !$this->MailInbox->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            if( $this->request->is( 'post' ) || $this->request->is( 'put' ) )
            {
                foreach( $this->request->data[ 'LeaderMail' ] as $key => $data )
                {
                   // if ( $data[ 'leader_id' ] == 0 ) unset( $this->request->data[ 'LeaderMail' ][ $key ] );
                }
                if( $this->MailInbox->saveAssociated( $this->request->data, array( 'deep' => true )  ) )
                {
                    $this->Session->setFlash( __( MSG_DATA_EDIT_SUCCESS ), 'Bootstrap/flash-success' );
                    //return $this->redirect( array( 'action' => ACTION_INDEX ) );
                }
            }
            else
            {
                $this->request->data = $this->MailInbox->read( null, $id );
            }     

        }
    }

?>