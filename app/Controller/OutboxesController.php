<?php

    class OutboxesController extends AppController
    {
        
        public $model_name      = 'Outbox';
        public $module_title    = 'Surat Keluar';
        public $module_desc     = ''; 
        public $module_icon     = 'fa fa-send';       
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

            $this->loadModel( 'Leader' );
            $this->LoadModel( 'OutboxLeader' );

            $mail_types     = $this->Outbox->getMailTypes(); 

            $leaders_all = $this->Leader->find( 'list', array( 
                'fields' => array( 'Leader.id', 'Leader.name' ) 
            ) );

            $this->set( compact( 'var_model', 'module_title', 'module_desc', 'title_for_layout', 'leaders_all', 'module_icon', 'mail_types' ) );            

        }

        public function admin_index()
        {
            $options[ 'recursive' ] = 1;
            
            $options[ 'order' ]      = array( 'Outbox.id' => 'DESC' );
            $this->Paginator->settings = $options;
            $datas = $this->Paginator->paginate( $this->model_name );

            $this->set( compact( 'datas' ) );             
        }

        public function admin_add()
        {
            if( $this->request->is( 'post' ) )
            {
                $this->Outbox->create();
                $this->request->data[ 'Outbox' ][ 'status' ] = 1;
                if( $this->Outbox->saveAssociated( $this->request->data, array( 'deep' => true ) ) )
                {
                    $this->Session->setFlash( __( MSG_DATA_UPDATE_SUCCESS ), 'Bootstrap/flash-success' );
                    return $this->redirect( array( 'action' => ACTION_INDEX ) );
                }
                else
                {
                    $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ) );
                }
            }
            $created = date( 'Y-m-d h:i:s' );
            $data  = $this->Outbox->find( 'first', array( 'fields' => array( 'no_arsip' ), 'order' => 'Outbox.id DESC' ) );
            $value = isset( $data[ 'Outbox' ][ 'no_arsip'] ) ? $data[ 'Outbox' ][ 'no_arsip'] : 0;
            $len   = strlen( $value );
            $max   = (int) substr($value, 3, $len);
            $max++;
            $newid = 'OX-' . sprintf("%04s", $max);
            
            $leaders = $this->Leader->find( 'list', array( 'conditions' => array( 'NOT' => array( 'type' => 1 ) ) ) );
            $this->request->data[ 'Outbox' ][ 'no_arsip' ] = $newid;
            $this->set( compact( 'leaders', 'newid' ) );            
        }

        public function admin_edit( $id = null ) 
        {
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->Outbox->id = $id;
            if( !$this->Outbox->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            if( $this->request->is( 'post' ) || $this->request->is( 'put' ) )
            {

                //$this->set( 'x', $x );
                $this->OutboxLeader->deleteAll( array( 'OutboxLeader.outbox_id' => $id ), false );
                if( $this->Outbox->saveAssociated( $this->request->data, array( 'deep' => true ) ) )
                {
                    $this->Session->setFlash( __( MSG_DATA_EDIT_SUCCESS ), 'Bootstrap/flash-success' );
                    return $this->redirect( array( 'action' => ACTION_INDEX ) );
                }
            }
            else
            {
                $leaders = $this->Outbox->Leader->find( 'list', array( 'conditions' => array( 'type' => 1 ) ) );
                $this->set( compact( 'leaders' ) );
                $this->request->data = $this->Outbox->read( null, $id );
            }     


        }

        public function assistant_index()
        {

            $options[ 'conditions' ] = array( 'OutboxLeader.leader_id' => $this->auth_leader_id );
            $options[ 'joins' ]      = array(
                array(
                    'table' => 'outbox_leaders',
                    'alias' => 'OutboxLeader',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Outbox.id = OutboxLeader.outbox_id'
                    )
                ),
                array(
                    'table' => 'leaders',
                    'alias' => 'Leader',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'OutboxLeader.leader_id = Leader.id'
                    )
                )
            );
            $options[ 'order' ]      = array( 'Outbox.id' => 'DESC' );
            $this->Paginator->settings = $options;
            $datas = $this->Paginator->paginate( $this->model_name );

            $this->set( compact( 'datas' ) );             
        }

        public function assistant_read( $id = null )
        {
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->Outbox->id = $id;
            if( !$this->Outbox->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            /*
            if( $this->Outbox->updateAll( array( 'status' => 0 ), array( 'id' => $id ) ) )
                 $this->Session->setFlash( __( MSG_DATA_UPDATE_SUCCESS ), 'Bootstrap/flash-success' );
            else $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ) );
            */
            $this->set( 'data', $this->Outbox->read( null, $id ) );
            //return $this->redirect( array( 'action' => ACTION_INDEX ) );

        }

        public function assistant_approved( $id = null )
        {
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->Outbox->id = $id;
            if( !$this->Outbox->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            if( $this->Outbox->OutboxLeader->updateAll( array( 'OutboxLeader.status' => 1 ), array( 'outbox_id' => $id, 'OutboxLeader.leader_id' => $this->auth_leader_id ) ) )
                 $this->Session->setFlash( __( MSG_DATA_UPDATE_SUCCESS ), 'Bootstrap/flash-success' );
            else $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ) );

            //$this->set( 'data', $this->MailInbox->read( null, $id ) );
            return $this->redirect( array( 'action' => ACTION_INDEX ) );

        }

        public function assistant_not_approved( $id = null )
        {
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->Outbox->id = $id;
            if( !$this->Outbox->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            if( $this->Outbox->OutboxLeader->updateAll( array( 'OutboxLeader.status' => 0 ), array( 'outbox_id' => $id, 'OutboxLeader.leader_id' => $this->auth_leader_id ) ) )
                 $this->Session->setFlash( __( MSG_DATA_UPDATE_SUCCESS ), 'Bootstrap/flash-success' );
            else $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ) );

            //$this->set( 'data', $this->MailInbox->read( null, $id ) );
            return $this->redirect( array( 'action' => ACTION_INDEX ) );

        }

        public function unit_index()
        {
            $this->assistant_index();
        }
        public function unit_read( $id = null )
        {
            $this->assistant_read( $id );
        }

        public function unit_approved( $id = null )
        {
            $this->assistant_approved( $id );
        }

        public function unit_not_approved( $id = null )
        {
            $this->assistant_not_approved( $id );
        }
    }

?>