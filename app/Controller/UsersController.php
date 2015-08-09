<?php
//App::uses( 'SimplePasswordHasher', 'Controller/Component/Auth' );
//App::uses( 'CakeEmail', 'Network/Email' );
//App::import('Controller', 'EmailFormats');

    class UsersController extends AppController
    {
        
        public $model_name      = 'User';
        public $module_title    = 'User Accounts';
        public $module_desc     = '';
        public $module_icon     = 'fa fa-user';
                
        public function beforeFilter()
        {
            parent::beforeFilter();
            
            $this->Auth->allow( 'add', 'logout' );
           // $this->Auth->fields = array( 'username' => 'email', 'password' => 'password' );
            /*$this->Auth->authenticate = array(
                'Form' => array(
                    'fields' => array('username' => 'email', 'password' => 'password'),
                ),
            );
            */
            if( isset( $this->request->params[ 'admin' ] ) )
            {
                $this->Auth->authenticate = array(
                    'Form' => array(
                        'scope' => array( 'User.role' => 'admin' ),
                    ),
                );                
            } elseif( isset( $this->request->params[ 'leader' ] ) ){
                $this->Auth->authenticate = array(
                    'Form' => array(
                        //'scope' => array( 'User.role' => 'leader' ),
                    ),
                );                
            } elseif( isset( $this->request->params[ 'assistant' ] ) ){
                $this->Auth->authenticate = array(
                    'Form' => array(
                        'scope' => array( 'User.role' => 'assistant' ),
                    ),
                );                
            } elseif( isset( $this->request->params[ 'unit' ] ) ){
                $this->Auth->authenticate = array(
                    'Form' => array(
                        'scope' => array( 'User.role' => 'unit' ),
                    ),
                );                
            }

            $var_model      = $this->model_name;
            $module_title   = $this->module_title;
            $module_desc    = $this->module_title;
            $module_icon    = $this->module_icon;
            $title_for_layout = $module_title;

            $roles      = $this->User->getTypeRoles();
            $genders    = $this->User->getTypeGenders();

            $this->set( compact( 'var_model', 'roles', 'genders', 'module_title', 'module_desc', 'module_icon', 'title_for_layout' ) );
            
        }
        
        public function admin_login()
        {
            
            $this->Auth->authenticate = array(
                'Form' => array(
                    'scope' => array( 'User.status' => 0, 'User.role' => 'admin' ),
                ),
            );

            $this->login();
        }
        
        public function admin_logout()
        {
            return $this->redirect( $this->Auth->logout() );
        }
        
        public function admin_index()
        {
            $this->Paginator->settings = array( 'order' => array( 'created' => 'DESC' ), 'conditions' => array( 'User.role !=' => '2f241db770519cd98aa5f8020f642cbc' ) );
            $datas = $this->Paginator->paginate( $this->model_name );
            $this->set( compact( 'datas' ) );
        }
        
        public function admin_add()
        {
            
            $this->set( 'title_for_layout', 'Add ' . $this->module_title );
            
            /*
            $this->request->data[ $this->model_name ][ 'role' ] = 'user';
            $this->request->data[ $this->model_name ][ 'status' ] = 1;
            */
            
            if( $this->request->is( 'post' ) )
            {
                
                /*
                 *  
                 */
                
                // pr( $this->request->data );
                
                $password   = $this->request->data[ $this->model_name ][ 'password' ];
                $rpassword  = $this->request->data[ $this->model_name ][ 'rpassword' ];
                
                if( $password == $rpassword )
                {
                    
                    $this->request->data[ $this->model_name ][ 'password' ];
                    //$this->request->data[ $this->model_name ][ 'role' ]   = 'administrator';
                    $this->request->data[ $this->model_name ][ 'activation_key' ] = String::uuid();
                    
                    $this->User->create();
                    if( $this->User->save( $this->request->data ) )
                    {
                        $this->Session->setFlash( __( MSG_DATA_SAVE_SUCCESS ), 'Bootstrap/flash-success' );
                        return $this->redirect( array( 'action' => ACTION_INDEX ) );
                    }
                    else
                    {
                        $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ), 'Bootstrap/flash-error' );
                    }
                    
                }
                else
                {
                    $this->Session->setFlash( __( MSG_PASSWORD_MISMATCH ), 'Bootstrap/flash-error' );
                }
                
            }
        }        
        public function admin_profile( $id = null )
        {
            
            $module_title       = 'User Profile';
            $title_for_layout   = $module_title;
            
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->User->locale = 'ind';
            $this->User->id = $id;
            
            if( !$this->User->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $options[ 'conditions' ] = array( 'User.id' => $id );
            $options[ 'recursive' ] = 3;
            $data = $this->User->find( 'first', $options );
            $this->set( compact( 'module_title', 'title_for_layout', 'data' ) );
            
        }
        
        public function admin_edit( $id = null )
        {
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->User->id = $id;
            if( !$this->User->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            if( $this->request->is( 'post' ) || $this->request->is( 'put' ) )
            {
                
                $passwordHasher = new SimplePasswordHasher();
                /* Change Password */
                $opassword  = $passwordHasher->hash( $this->request->data[ $this->model_name ][ 'opassword' ] );
                $npassword  = $this->request->data[ $this->model_name ][ 'npassword' ];
                $rnpassword = $this->request->data[ $this->model_name ][ 'rnpassword' ];
                
                if( ( strlen( $opassword ) > 0 ) && ( strlen( $npassword ) > 0 ) && ( strlen( $rnpassword ) > 0 ) )
                {
                    
                    /* Check old password */
                    $check_old_password = $this->User->find( 'first', array( 
                        'conditions' => array(
                            'User.email' => $this->request->data[ $this->model_name ][ 'email' ],
                            'User.password'  => $opassword
                        )
                    ));
                    if( !empty( $check_old_password ) )
                    {
                        if( $npassword == $rnpassword )
                        {
                            $this->request->data[ $this->model_name ][ 'password' ] = $rnpassword;
                            $this->User->save( $this->request->data );

                            $this->Session->setFlash( __( MSG_DATA_EDIT_SUCCESS ), 'Bootstrap/flash-success' );
                            return $this->redirect( array( 'action' => ACTION_INDEX ) );
                        } else {
                            $this->Session->setFlash( __( MSG_PASSWORD_MISMATCH ), 'Bootstrap/flash-error' );
                        }
                    }
                    else
                    {
                        $this->Session->setFlash( __( MSG_PASSWORD_WRONG . $opassword), 'Bootstrap/flash-error' );
                    }
                    $this->request->data = $this->User->read( null, $id );
                    unset( $this->request->data[ 'User' ][ 'password' ] );
                    return false;
                }
                
                //pr( $this->request->data );
                
                
                /* Change Image */
                
                
                if( $this->User->save( $this->request->data ) )
                {
                    $this->Session->setFlash( __( MSG_DATA_EDIT_SUCCESS ), 'Bootstrap/flash-success' );
                    return $this->redirect( array( 'action' => ACTION_INDEX ) );
                } else {
                
                    $this->Session->setFlash( __( MSG_DATA_EDIT_FAILED ), 'Bootstrap/flash-error' );
                }
                
            }
            else
            {
                $this->request->data = $this->User->read( null, $id );
                unset( $this->request->data[ 'User' ][ 'password' ] );
            }
            
        }
        
        
        public function admin_enable( $id = null )
        {
            $this->request->onlyAllow( 'post' );
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->User->id = $id;
            if( !$this->User->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->request->data[ $this->model_name ][ 'status' ] = 0;
            
            if( $this->User->save( $this->request->data ) )
            {
                $this->Session->setFlash( __( MSG_DATA_EDIT_SUCCESS ), 'Bootstrap/flash-success' );
                return $this->redirect( array( 'action' => ACTION_INDEX ) );
            }
            
            $this->Session->setFlash( __( MSG_DATA_EDIT_FAILED ), 'Bootstrap/flash-error' );
            return $this->redirect( array( 'action' => ACTION_INDEX ) );
        }
        
        public function admin_disable( $id = null )
        {
            $this->request->onlyAllow( 'post' );
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->User->id = $id;
            if( !$this->User->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->request->data[ $this->model_name ][ 'status' ] = 1;
            
            if( $this->User->save( $this->request->data ) )
            {
                $this->Session->setFlash( __( MSG_DATA_EDIT_SUCCESS ), 'Bootstrap/flash-success' );
                return $this->redirect( array( 'action' => ACTION_INDEX ) );
            }
            
            $this->Session->setFlash( __( MSG_DATA_EDIT_FAILED ), 'Bootstrap/flash-error' );
            return $this->redirect( array( 'action' => ACTION_INDEX ) );
        }      

        public function leader_login( $id = null )
        {
            $this->login();
        }
        public function profile( $id = null )
        {

            $auth_data          = $this->Auth->user();
            $id                 = $auth_data[ 'id' ];

            $this->User->id = $id;
            if( !$this->User->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $data = $this->User->find( 'first', array( 
                'conditions' => array( 'User.id' => $id ), 
                'recursive' => -1
            ));
            $this->request->data = $data;
            $this->set( 'data', $data );
            
        }

        public function register()
        {
            
            $this->set( 'title_for_layout', 'Add ' . $this->module_title );
            
            $this->request->data[ $this->model_name ][ 'role' ] = 'user';
            $this->request->data[ $this->model_name ][ 'status' ] = 1;
            if( $this->request->is( 'post' ) )
            {
                
                /*
                 *  
                 */
                
                // pr( $this->request->data );
                if( $this->User->findByEmail( $this->request->data[ $this->model_name ][ 'email' ] ) )
                {
                    $this->Session->setFLash( __( 'Your email has been registered' ), 'Bootstrap/flash-error' );
                    return $this->redirect( array( 'controller' => 'users', 'action' => 'login' ) );
                }

                $password   = $this->request->data[ $this->model_name ][ 'password' ];
                $rpassword  = $this->request->data[ $this->model_name ][ 'rpassword' ];
                
                if( $password == $rpassword )
                {
                 
                    $activation_key = String::uuid();
                    $this->request->data[ $this->model_name ][ 'password' ];
                    $this->request->data[ $this->model_name ][ 'activation_key' ] = $activation_key;

                    $EmailFormat = new EmailFormatsController;
                    
                    $to = array( 'email' => $this->request->data[ $this->model_name ][ 'email' ], 'fullname' => $this->request->data[ $this->model_name ][ 'name' ] );

                    $EmailFormat->send_email_custom( 'verification-account', $to, $activation_key); // To, Activaction Key 
                    $this->User->create();
                    if( $this->User->save( $this->request->data ) )
                    {

                        $this->Session->setFlash( __( 'Successfully registered, please check your email to activation key' ), 'Bootstrap/flash-success' );
                        //return $this->redirect( array( 'controller' => 'home', 'action' => ACTION_INDEX ) );
                    }
                    else
                    {
                        $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ), 'Bootstrap/flash-error' );
                    }
                    
                }
                else
                {
                    $this->Session->setFlash( __( MSG_PASSWORD_MISMATCH ), 'Bootstrap/flash-error' );
                }
                
            }
        }

        public function activation( $key = null )
        {

            if( !$key )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }

            $user = $this->User->findByActivationKey( $key );
            if( !empty( $user ) )
            {
                $this->User->updateAll( array( 'User.status' => 0 ), array( 'User.activation_key' => $key ) );
                $this->Session->setFlash( __( 'Successfully to activation your key account, you can login right now' ), 'Bootstrap/flash-success' );
                return $this->redirect( array( 'action' => 'login' ) );
            } else {
                return $this->redirect( array( 'controller' => 'home', 'action' => 'index' ) );
            }
        }

        public function login()
        {

            $this->layout = 'login';
            $this->autoRender = false;
            
            if( $this->request->is( 'post' ) )
            {

                if( $this->Auth->login() )
                {
                    //$this->Auth->redirect();
                    //return $this->redirect( array( 'controller' => 'home', 'action' => 'index' ));
                }
                $this->Session->setFlash( __( 'Invalid username or password' ), 'Bootstrap/flash-error' );
                //$this->Session->setFlash( __( MSG_DATA_SAVE_SUCCESS ), 'Bootstrap/flash-success' );
            }
            
            $this->render( 'login' );
        }
      
        public function logout()
        {
            $this->Auth->logout();
            return $this->redirect( array( 'controller' => 'home', 'action' => 'index' ) );
        }

        public function order( $status = null )
        {

            if( !$status )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }

            $status = $status == 'history' ? 0 : 1;

            $auth_data          = $this->Auth->user();
            $id                 = $auth_data[ 'id' ];

            $this->User->id = $id;
            if( !$this->User->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $datas = $this->User->Transaction->find( 'all', array( 
                'conditions' => array( 'Transaction.user_id' => $id, 'Transaction.status' => $status ),
                'contain' => array( 'UserAddress' ),
                'order' => 'Transaction.id DESC'
            ) );
            $this->set( compact( 'datas' ) );
        }

        public function edit()
        {
            $auth_data          = $this->Auth->user();
            $id                 = $auth_data[ 'id' ];

            $this->User->id = $id;
            if( !$this->User->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->User->id = $id;
            if( !$this->User->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            if( $this->request->is( 'post' ) || $this->request->is( 'put' ) )
            {
                
                $passwordHasher = new SimplePasswordHasher();
                /* Change Password */
                $opassword  = $passwordHasher->hash( $this->request->data[ $this->model_name ][ 'opassword' ] );
                $npassword  = $this->request->data[ $this->model_name ][ 'npassword' ];
                $rnpassword = $this->request->data[ $this->model_name ][ 'rnpassword' ];
                
                if( ( strlen( $opassword ) > 0 ) && ( strlen( $npassword ) > 0 ) && ( strlen( $rnpassword ) > 0 ) )
                {
                    
                    /* Check old password */
                    $check_old_password = $this->User->find( 'first', array( 
                        'conditions' => array(
                            'User.email' => $this->request->data[ $this->model_name ][ 'email' ],
                            'User.password'  => $opassword
                        )
                    ));
                    if( !empty( $check_old_password ) )
                    {
                        if( $npassword == $rnpassword )
                        {
                            $this->request->data[ $this->model_name ][ 'password' ] = $rnpassword;
                            $this->User->save( $this->request->data );

                            $this->Session->setFlash( __( MSG_DATA_EDIT_SUCCESS ), 'Bootstrap/flash-success' );
                            return $this->redirect( array( 'action' => 'profile' ) );
                        } else {
                            $this->Session->setFlash( __( MSG_PASSWORD_MISMATCH ), 'Bootstrap/flash-error' );
                        }
                    }
                    else
                    {
                        $this->Session->setFlash( __( MSG_PASSWORD_WRONG ), 'Bootstrap/flash-error' );
                    }
                    $this->request->data = $this->User->read( null, $id );
                    unset( $this->request->data[ 'User' ][ 'password' ] );
                    return false;
                }
                
                //pr( $this->request->data );
                
                
                /* Change Image */
                
                
                if( $this->User->save( $this->request->data ) )
                {
                    $this->Session->setFlash( __( MSG_DATA_EDIT_SUCCESS ), 'Bootstrap/flash-success' );
                    return $this->redirect( array( 'action' => 'profile' ) );
                } else {
                
                    $this->Session->setFlash( __( MSG_DATA_EDIT_FAILED ), 'Bootstrap/flash-error' );
                }
                
            }
            else
            {
                            
                $data = $this->User->find( 'first', array( 
                    'conditions' => array( 'User.id' => $id ), 
                    'contain' => array( 'Transaction' => array( 'TransactionDetail' => array( 'fields' => 'qty' ) ) )
                ));
                $this->request->data = $data;
                $this->set( 'data', $data );
                unset( $this->request->data[ 'User' ][ 'password' ] );
            }

        }

        public function forgot_password()
        {

            if( $this->request->is( 'post' ) )
            {

                $check_email = $this->User->find( 'first', array( 
                    'conditions' => array(
                        'User.email' => $this->request->data[ $this->model_name ][ 'email' ],
                    )
                ));
                if ( !empty( $check_email ) )
                {

                    $user = $check_email[ 'User'];
                    if ( $user[ 'status' ] == 1 )
                    {
                        $this->Session->setFlash( __( 'Your account has been disabled' ), 'Bootstrap/flash-danger' );
                    } else {

                        $key = String::uuid();
                        $this->User->updateAll( array( 'User.activation_key' => "'" . $key . "'" ), array( 'User.email' => $user[ 'email' ] ) );
                        $EmailFormat = new EmailFormatsController;
                        
                        $to = array( 'email' => $user[ 'email' ], 'fullname' => $user[ 'name' ] );

                        $EmailFormat->send_email_custom( 'forgot-password', $to, $key); // To, Activaction Key 
                        $this->Session->setFlash( __( 'Successfully, please check your email to activation key' ), 'Bootstrap/flash-success' );
                        $this->redirect( 'login' );
                    }
                } else {
                    $this->Session->setFlash( __( 'Your email not exists, correct your email' ), 'Bootstrap/flash-success' );
                }

            }
        }

        public function change_password( $key = null )
        {

            if( !$key )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $user = $this->User->findByActivationKey( $key );

            if( !$user )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            if( $this->request->is( 'post' ) || $this->request->is( 'put' ) )
            {
                //$passwordHasher = new SimplePasswordHasher();
                /* Change Password */
                $npassword  = $this->request->data[ $this->model_name ][ 'npassword' ];
                $rnpassword = $this->request->data[ $this->model_name ][ 'rnpassword' ];

                if( $npassword == $rnpassword )
                {
                    $this->request->data[ $this->model_name ][ 'password' ] = $rnpassword;
                    $this->request->data[ $this->model_name ][ 'id' ] = $user[ 'User' ][ 'id' ];
                    $this->User->save( $this->request->data );

                    $this->Session->setFlash( __( MSG_DATA_EDIT_SUCCESS ), 'Bootstrap/flash-success' );
                    return $this->redirect( array( 'action' => 'login' ) );
                } else {
                    $this->Session->setFlash( __( MSG_PASSWORD_MISMATCH ), 'Bootstrap/flash-error' );
                }

            }
            else
            {
                $this->request->data[ 'User' ][ 'key' ] = $key;
                //$this->request->data[ $this->model_name ][ 'type_text' ] = $this->request->data[ $this->model_name ][ 'type' ];
            }

        }

    }

?>