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
            $this->loadModel( 'LeaderMail' );
            $this->loadModel( 'Notification' );

            $this->set( compact( 'var_model', 'module_title', 'module_desc', 'module_icon', 'readed_status', 'mail_types' ) );
            
            $leader_assistants = $this->Leader->find( 'list', array( 
                'conditions' => array( 'Leader.type' => 2 ),
                'fields' => array( 'Leader.id', 'Leader.name' )
            ) );   

            $leader_units = $this->Leader->find( 'list', array( 
                'conditions' => array( 'Leader.type' => 3 ),
                'fields' => array( 'Leader.id', 'Leader.name' )
            ) );   
            
            $this->set( compact( 'leader_units', 'leader_assistants', 'mail_types' ) );   
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
            $created = date( 'Y-m-d h:i:s' );
            $data  = $this->MailInbox->find( 'first', array( 'fields' => array( 'no_arsip' ), 'order' => 'MailInbox.id DESC' ) );
            $value = isset( $data[ 'MailInbox' ][ 'no_arsip'] ) ? $data[ 'MailInbox' ][ 'no_arsip'] : 0;
            $len   = strlen( $value );
            $max   = (int) substr($value, 3, $len);
            $max++;
            $newid = 'AS-' . sprintf("%04s", $max);
            
            $leaders = $this->MailInbox->Leader->find( 'list', array( 'conditions' => array( 'type' => 1 ) ) );
            $this->request->data[ 'MailInbox' ][ 'no_arsip' ] = $newid;
            $this->set( compact( 'leaders', 'newid' ) );
        }

        public function admin_index()
        {
            
            //$this->layout = LAYOUT_ADMIN;
            
            $options[ 'contain' ]    = array( 'LeaderMail' );
            $options[ 'order' ]      = array( 'MailInbox.id' => 'DESC' );
            $this->Paginator->settings = $options;
            $datas = $this->Paginator->paginate( $this->model_name );

            //$datas = $this->MailInbox->find( 'all', $options );
            $this->set( compact( 'datas' ) );            
        }
        
        public function admin_edit( $id = null ) 
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

                //$this->set( 'x', $x );                
                if( $this->MailInbox->saveAssociated( $this->request->data, array( 'deep' => true ) ) )
                {
                    $this->Session->setFlash( __( MSG_DATA_EDIT_SUCCESS ), 'Bootstrap/flash-success' );
                    return $this->redirect( array( 'action' => ACTION_INDEX ) );
                }
            }
            else
            {
                $leaders = $this->MailInbox->Leader->find( 'list', array( 'conditions' => array( 'type' => 1 ) ) );
                $this->set( compact( 'leaders' ) );
                $this->request->data = $this->MailInbox->read( null, $id );
            }     


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

            if( !$this->Notification->updateAll( array( 'status' => 1 ), array( 'Notification.content_id' => $id, 'Notification.content' => 'mail_inboxes' ) ) )
                 $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ), 'Bootstrap/flash-error' );

            $options[ 'conditions' ] = array(
                'MailInbox.id' => $id
            );
            $options[ 'contain' ] = array(
                'LeaderMail',
                'Assistant' => array(
                    'conditions' => array( 'Assistant.type' => 2 )
                ),
                'Unit' => array(
                    'conditions' => array( 'Unit.type' => 3 )
                )
            );
            $data = $this->MailInbox->find( 'first', $options );
            $this->set( 'data', $data );
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
            $options[ 'joins' ] = array(
                array( 
                    'table' => 'leader_mails',
                    'alias' => 'LeaderMail',
                    'type' => 'INNER',
                    'conditions' => array(
                        'LeaderMail.mail_inbox_id = MailInbox.id'
                    )
                )
            );
            $options[ 'conditions' ] = array( 'LeaderMail.leader_id' => $this->auth_leader_id );
            $options[ 'contain' ]    = array( 'LeaderMail' => array( 'conditions' => array( 'LeaderMail.leader_id' => $this->auth_leader_id ) ) );
            $options[ 'order' ]      = array( 'MailInbox.id' => 'DESC' );
            $this->Paginator->settings = $options;
            $datas = $this->Paginator->paginate( $this->model_name );

            //$datas = $this->MailInbox->find( 'all', $options );
            $this->set( compact( 'datas' ) );
        }

        public function approved( $id = null )
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
            if( $this->MailInbox->LeaderMail->updateAll( array( 'LeaderMail.status' => 1 ), array( 'mail_inbox_id' => $id, 'LeaderMail.leader_id' => $this->auth_leader_id ) ) )
                 $this->Session->setFlash( __( MSG_DATA_UPDATE_SUCCESS ), 'Bootstrap/flash-success' );
            else $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ) );

            $this->Notification->addNotif( $id, 'mail_inboxes', 'approved', 'read', 1 );

            //$this->set( 'data', $this->MailInbox->read( null, $id ) );
            return $this->redirect( array( 'action' => ACTION_INDEX ) );

        }

        public function not_approved( $id = null )
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
            if( $this->MailInbox->LeaderMail->updateAll( array( 'LeaderMail.status' => 0 ), array( 'mail_inbox_id' => $id, 'LeaderMail.leader_id' => $this->auth_leader_id ) ) )
                 $this->Session->setFlash( __( MSG_DATA_UPDATE_SUCCESS ), 'Bootstrap/flash-success' );
            else $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ) );

            $this->Notification->addNotif( $id, 'mail_inboxes', 'not_approved', 'read', 0 );
            //$this->set( 'data', $this->MailInbox->read( null, $id ) );
            return $this->redirect( array( 'action' => ACTION_INDEX ) );

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

        public function leader_index()
        {
            $options[ 'contain' ]    = array( 'LeaderMail' );
            $options[ 'order' ]      = array( 'MailInbox.id' => 'DESC' );
            $this->Paginator->settings = $options;
            $datas = $this->Paginator->paginate( $this->model_name );

            //$datas = $this->MailInbox->find( 'all', $options );
            $this->set( compact( 'datas' ) );
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
                /*foreach( $this->request->data[ 'LeaderMail' ] as $key => $data )
                {
                    //if ( $data[ 'leader_id' ] == 0 ) unset( $this->request->data[ 'LeaderMail' ][ $key ] );
                }*/

                //$x = $this->MailInbox->Unit->find( 'all', array( 'conditions' => array( 'Unit.type' => 2, 'LeaderMail.mail_inbox' =>2 ) ) );
                $options[ 'joins' ] = array(
                    array( 
                        'table' => 'leader_mails',
                        'alias' => 'LeaderMail',
                        'type' => 'INNER',
                        'conditions' => array(
                            'LeaderMail.leader_id = Leader.id'
                        )
                    )
                );
                $options[ 'conditions' ] = array( 'LeaderMail.mail_inbox_id' => $id, 'Leader.type' => 2 );
                $options[ 'fields' ] = array( 'Leader.id' );
                $x = $this->Leader->find( 'list', $options );
                $z = array();
                
                foreach( $x as $id )
                {
                    $z[]= $id;
                }

                $this->LeaderMail->deleteAll( array( 'Leader.id' => $z ), false );  
                //$this->set( 'x', $x );                
                if( $this->MailInbox->saveAssociated( $this->request->data, array( 'deep' => true ) ) )
                {
                    $this->Session->setFlash( __( MSG_DATA_EDIT_SUCCESS ), 'Bootstrap/flash-success' );
                    return $this->redirect( array( 'action' => ACTION_INDEX ) );
                }
            }
            else
            {
                $this->request->data = $this->MailInbox->read( null, $id );
            }     


        }

        public function leader_approved( $id = null )
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
            if( $this->MailInbox->updateAll( array( 'MailInbox.leader_status' => 1 ), array( 'MailInbox.id' => $id ) ) )
                 $this->Session->setFlash( __( MSG_DATA_UPDATE_SUCCESS ), 'Bootstrap/flash-success' );
            else $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ) );

            //$this->set( 'data', $this->MailInbox->read( null, $id ) );
            return $this->redirect( array( 'action' => ACTION_INDEX ) );
        }

        public function leader_not_approved( $id = null )
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
            if( $this->MailInbox->updateAll( array( 'MailInbox.leader_status' => 0 ), array( 'MailInbox.id' => $id ) ) )
                 $this->Session->setFlash( __( MSG_DATA_UPDATE_SUCCESS ), 'Bootstrap/flash-success' );
            else $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ) );

            //$this->set( 'data', $this->MailInbox->read( null, $id ) );
            return $this->redirect( array( 'action' => ACTION_INDEX ) );

        }

        public function leader_inbox_notif()
        {
            $this->autoRender = false;

            $count = $this->MailInbox->find( 'count', array( 'conditions' => array( 'MailInbox.leader_id' => $this->auth_leader_id, 'MailInbox.leader_status' => 0 ) ) );
            if ( $count > 0 )
                return $count;
        }

        public function assistant_approved( $id = null )
        {
            $this->approved( $id );
        }
        
        public function assistant_not_approved( $id = null )
        {
            $this->not_approved( $id );
        } 

        public function assistant_index()
        {
            $this->index();
        }

        public function assistant_read( $id = null ) 
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
/*                
                foreach( $this->request->data[ 'LeaderMail' ] as $key => $data )
                {
                   // if ( $data[ 'leader_id' ] == 0 ) unset( $this->request->data[ 'LeaderMail' ][ $key ] );
                }
                $options[ 'joins' ] = array(
                    array( 
                        'table' => 'leader_mails',
                        'alias' => 'LeaderMail',
                        'type' => 'INNER',
                        'conditions' => array(
                            'LeaderMail.leader_id = Leader.id'
                        )
                    )
                );
                $options[ 'conditions' ] = array( 'LeaderMail.mail_inbox_id' => $id, 'LeaderMail.status' => 0, 'Leader.type' => 3 );
                $options[ 'fields' ] = array( 'Leader.id' );
                $x = $this->Leader->find( 'list', $options );
*/
                $options[ 'joins' ] = array(
                    array( 
                        'table' => 'leader_mails',
                        'alias' => 'LeaderMail',
                        'type' => 'INNER',
                        'conditions' => array(
                            'LeaderMail.leader_id = Leader.id'
                        )
                    )
                );
                $options[ 'conditions' ] = array( 'LeaderMail.mail_inbox_id' => $id, 'Leader.type' => 3 );
                $options[ 'fields' ] = array( 'Leader.id' );
                $x = $this->Leader->find( 'list', $options );
                $z = array();
                
                foreach( $x as $id )
                {
                    $z[]= $id;
                }

                $this->LeaderMail->deleteAll( array( 'Leader.id' => $z ), false );                
                if( $this->MailInbox->saveAssociated( $this->request->data, array( 'deep' => true )  ) )
                {
                    $this->Session->setFlash( __( MSG_DATA_EDIT_SUCCESS ), 'Bootstrap/flash-success' );
                    return $this->redirect( array( 'action' => ACTION_INDEX ) );
                }
            }
            else
            {
                $this->request->data = $this->MailInbox->read( null, $id );
                $options[ 'joins' ] = array(
                    array( 
                        'table' => 'leader_mails',
                        'alias' => 'LeaderMail',
                        'type' => 'INNER',
                        'conditions' => array(
                            'LeaderMail.leader_id = Leader.id'
                        )
                    )
                );
                $options[ 'conditions' ] = array( 'LeaderMail.mail_inbox_id' => 2, 'LeaderMail.status' => 0, 'Leader.type' => 3 );
                $options[ 'fields' ] = array( 'Leader.id' );
                $x = $this->Leader->find( 'list', $options );
                $z = array();
                foreach( $x as $id )
                {
                    $z[][ 'id' ] = $id;
                }
                $this->set( 'x', $z );            
            }
        }


        public function unit_index()
        {
            $this->index();
            
            //$this->render( '/MailInboxes/assistant_index' );            
        }

        public function unit_read($id = null)
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
        
            $this->request->data = $this->MailInbox->read( null, $id );
            $options[ 'joins' ] = array(
                array( 
                    'table' => 'leader_mails',
                    'alias' => 'LeaderMail',
                    'type' => 'INNER',
                    'conditions' => array(
                        'LeaderMail.leader_id = Leader.id'
                    )
                )
            );
            $options[ 'conditions' ] = array( 'LeaderMail.mail_inbox_id' => 2, 'LeaderMail.status' => 0, 'Leader.type' => 3 );
            $options[ 'fields' ] = array( 'Leader.id' );
            $x = $this->Leader->find( 'list', $options );
            $z = array();
            foreach( $x as $id )
            {
                $z[][ 'id' ] = $id;
            }
            $this->set( 'x', $z );            
        
        }

        public function unit_approved( $id = null )
        {
            $this->approved( $id );
        }
        
        public function unit_not_approved( $id = null )
        {
            $this->not_approved( $id );
        } 
    }