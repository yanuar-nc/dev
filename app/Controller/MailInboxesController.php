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
                    $datas = array( array( 
                        'sender_id'   => $this->auth_leader_id, 
                        'receiver_id' => 2,  // ID KETUA STIKOM
                        'content_id'  => $this->MailInbox->getInsertID(), 
                        'content'     => 'mail_inboxes',
                        'action'      => 'add',
                        'redirect'    => 'edit',
                        'mail_status' => 2 
                    ) );           
                    $this->Notification->addNotif( $datas );         
                    return $this->redirect( array( 'action' => ACTION_INDEX ) );
                }
                else
                {
                    $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ), 'Bootstrap/flash-error' );
                }
            }
            $created = date( 'Y-m-d h:i:s' );
/*            $data  = $this->MailInbox->find( 'first', array( 'fields' => array( 'no_arsip' ), 'order' => 'MailInbox.id DESC' ) );
            $value = isset( $data[ 'MailInbox' ][ 'no_arsip'] ) ? $data[ 'MailInbox' ][ 'no_arsip'] : 0;
            $len   = strlen( $value );
            $max   = (int) substr($value, 3, $len);
            $max++;
            $newid = 'AS-' . sprintf("%04s", $max);
*/            
            $data  = $this->MailInbox->find( 'first', array( 'fields' => array( 'id' ), 'order' => 'MailInbox.id DESC' ) );
            $value = isset( $data[ 'MailInbox' ][ 'id'] ) ? $data[ 'MailInbox' ][ 'id'] + 1 : 1;
            $no_surat = sprintf( "%03s", $value  ) . '/STIKOM-M/' . number2roman( date( 'm' ) ) . '/' . date( 'Y' );

            $newid = 'AS-' . sprintf("%04s", $value);
            
            $leaders = $this->MailInbox->Leader->find( 'list', array( 'conditions' => array( 'type' => 1 ) ) );
            $this->request->data[ 'MailInbox' ][ 'no_surat' ] = $no_surat;
            $this->request->data[ 'MailInbox' ][ 'no_arsip' ] = $newid;
            $this->set( compact( 'leaders' ) );
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

            if( !$this->Notification->updateAll( array( 'status' => 1 ), array( 'Notification.content_id' => $id, 'Notification.content' => 'mail_inboxes', 'Notification.receiver_id' => $this->auth_leader_id ) ) ) 
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
            else $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ), 'Bootstrap/flash-error' );

            $admin = array( array( 
                        'sender_id'   => $this->auth_leader_id, 
                        'receiver_id' => 1,  // ID ADMIN
                        'content_id'  => $id, 
                        'content'     => 'mail_inboxes',
                        'action'      => 'approved',
                        'redirect'    => 'read',
                        'mail_status' => 1 
                    ) );
            $this->Notification->addNotif( $admin );

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
            else $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ), 'Bootstrap/flash-error' );

            $admin = array( array( 
                        'sender_id'   => $this->auth_leader_id, 
                        'receiver_id' => 1,  // ID ADMIN
                        'content_id'  => $id, 
                        'content'     => 'mail_inboxes',
                        'action'      => 'not_approved',
                        'redirect'    => 'read',
                        'mail_status' => 0 
                    ) );
            $this->Notification->addNotif( $admin );

            //$this->set( 'data', $this->MailInbox->read( null, $id ) );
            return $this->redirect( array( 'action' => ACTION_INDEX ) );

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

            if( !$this->Notification->updateAll( array( 'status' => 1 ), array( 'Notification.content_id' => $id, 'Notification.content' => 'mail_inboxes', 'Notification.receiver_id' => $this->auth_leader_id ) ) )
                 $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ), 'Bootstrap/flash-error' );
            
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

                $datas = $leaders = array();

                $admin = array( array( 
                            'sender_id'   => $this->auth_leader_id, 
                            'receiver_id' => 1,  // ID ADMIN
                            'content_id'  => $id, 
                            'content'     => 'mail_inboxes',
                            'action'      => 'approved',
                            'redirect'    => 'read',
                            'mail_status' => 1 
                        ) );

                if( $this->MailInbox->saveAssociated( $this->request->data, array( 'deep' => true ) ) )
                {

                    $this->MailInbox->updateAll( array( 'MailInbox.leader_status' => 1 ), array( 'MailInbox.id' => $id ) );

                    $this->Session->setFlash( __( MSG_DATA_EDIT_SUCCESS ), 'Bootstrap/flash-success' );
                    if( !empty( $this->request->data[ $this->model_name ][ 'Assistant' ] ) )
                    {
                        foreach( $this->request->data[ $this->model_name ][ 'Assistant' ] as $key ):
                            $leaders[] = array( 
                                    'sender_id'   => $this->auth_leader_id, 
                                    'receiver_id' => $key,
                                    'content_id'  => $this->request->data[ $this->model_name ][ 'id' ], 
                                    'content'     => 'mail_inboxes',
                                    'action'      => 'add',
                                    'redirect'    => 'read',
                                    'mail_status' => 2 
                                );                            
                        endforeach;                        
                    }
                    $datas = array_merge( $admin, $leaders );   
                    $this->Notification->addNotif( $datas );

                    return $this->redirect( array( 'action' => ACTION_INDEX ) );
                } else {
                    $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ), 'Bootstrap/flash-error' );
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
            else $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ), 'Bootstrap/flash-error' );
            $admin = array( array( 
                        'sender_id'   => $this->auth_leader_id, 
                        'receiver_id' => 1,  // ID ADMIN
                        'content_id'  => $id, 
                        'content'     => 'mail_inboxes',
                        'action'      => 'approved',
                        'redirect'    => 'read',
                        'mail_status' => 1 
                    ) );
            $this->Notification->addNotif( $admin );
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
            else $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ), 'Bootstrap/flash-error' );

            $admin = array( array( 
                        'sender_id'   => $this->auth_leader_id, 
                        'receiver_id' => 1,  // ID ADMIN
                        'content_id'  => $id, 
                        'content'     => 'mail_inboxes',
                        'action'      => 'not_approved',
                        'redirect'    => 'read',
                        'mail_status' => 0 
                    ) );
            $this->Notification->addNotif( $admin );
            //$this->set( 'data', $this->MailInbox->read( null, $id ) );
            return $this->redirect( array( 'action' => ACTION_INDEX ) );

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

            if( !$this->Notification->updateAll( array( 'status' => 1 ), array( 'Notification.content_id' => $id, 'Notification.content' => 'mail_inboxes', 'Notification.receiver_id' =>  $this->auth_leader_id) ) )
                 $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ), 'Bootstrap/flash-error' );
            
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
                    $datas = $leaders = array();

                    if( !empty( $this->request->data[ $this->model_name ][ 'Unit' ] ) )
                    {
                        foreach( $this->request->data[ $this->model_name ][ 'Unit' ] as $key ):
                            //$this->Notification->addNotif( $this->request->data[ $this->model_name ][ 'id' ], 'mail_inboxes', 'add', 'read', 2, 'unit' );
                            $leaders[] = array( 
                                            'sender_id'   => $this->auth_leader_id, 
                                            'receiver_id' => $key,
                                            'content_id'  => $id, 
                                            'content'     => 'mail_inboxes',
                                            'action'      => 'add',
                                            'redirect'    => 'read',
                                            'mail_status' => 2 
                                        );
                        endforeach;                        
                    }                    
                    $admin = array( array( 
                        'sender_id'   => $this->auth_leader_id, 
                        'receiver_id' => 1,  // ID ADMIN
                        'content_id'  => $id, 
                        'content'     => 'mail_inboxes',
                        'action'      => 'approved',
                        'redirect'    => 'read',
                        'mail_status' => 1 
                    ) );
                    $datas = array_merge( $admin, $leaders );   

                    $this->MailInbox->LeaderMail->updateAll( array( 'LeaderMail.status' => 1 ), array( 'mail_inbox_id' => $id, 'LeaderMail.leader_id' => $this->auth_leader_id ) );
                    $this->Notification->addNotif( $datas );                     

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

            if( !$this->Notification->updateAll( array( 'status' => 1 ), array( 'Notification.content_id' => $id, 'Notification.content' => 'mail_inboxes', 'Notification.receiver_id' => $this->auth_leader_id ) ) )
                 $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ), 'Bootstrap/flash-error' );
        
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