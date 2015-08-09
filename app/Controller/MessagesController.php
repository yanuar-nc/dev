<?php

    class MessagesController extends AppController
    {
        
        public $model_name      = 'Message';
        public $module_title    = 'Messages';
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
            $this->set( compact( 'var_model', 'module_title', 'module_desc', 'module_icon', 'readed_status' ) );
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
            
            $this->Message->id = $id;
            if( !$this->Message->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            if( $this->Message->updateAll( array( 'status' => 0 ), array( 'id' => $id ) ) )
                 $this->Session->setFlash( __( MSG_DATA_UPDATE_SUCCESS ), 'Bootstrap/flash-success' );
            else $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ) );

            $this->set( 'data', $this->Message->read( null, $id ) );
            //return $this->redirect( array( 'action' => ACTION_INDEX ) );
            
        }
        
        public function admin_unread( $id = null )
        {
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->Message->id = $id;
            if( !$this->Message->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }

            if( $this->Message->updateAll( array( 'status' => 1 ), array( 'id' => $id ) ) )
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
            
            $this->Message->id = $id;
            if( !$this->Message->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            if( $this->Message->delete() )
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
                $this->Message->create();
                $this->request->data[ 'Message' ][ 'status' ] = 1;
                if( $this->Message->save( $this->request->data ) )
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

    }

?>