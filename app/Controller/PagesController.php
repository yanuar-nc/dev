<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

	App::uses('AppController', 'Controller');

	/**
	 * Static content controller
	 *
	 * Override this controller by placing a copy in controllers directory of an application
	 *
	 * @package       app.Controller
	 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
	 */
	class PagesController extends AppController {

	/**
	 * This controller does not use a model
	 *
	 * @var array
	 */
		public $uses = array();

	/**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 * @throws NotFoundException When the view file could not be found
	 *	or MissingViewException in debug mode.
	 */

	    public $model_name      = 'Page';
	    public $module_title    = TEXT_PAGE;
	    public $module_desc     = '';

	    public function beforeFilter()
	    {
	        parent::beforeFilter();
	        
	        $var_model      = $this->model_name;
	        $module_title   = $this->module_title;
	        $module_desc    = $this->module_title;
	        $title_for_layout = $module_title;
	        $page_types     = $this->page_types;

	        $published_status = array( 'Enabled', 'Disabled' );
	        $this->set( compact( 'var_model', 'module_title', 'module_desc', 'title_for_layout', 'published_status' ) );
	        
	        /* Module specific variables */
	        
	    }
		public function display() {
			$path = func_get_args();

			$count = count($path);
			if (!$count) {
				return $this->redirect('/');
			}
			$page = $subpage = $title_for_layout = null;

			if (!empty($path[0])) {
				$page = $path[0];
			}
			if (!empty($path[1])) {
				$subpage = $path[1];
			}
			if (!empty($path[$count - 1])) {
				$title_for_layout = Inflector::humanize($path[$count - 1]);
			}
			$this->set(compact('page', 'subpage', 'title_for_layout'));

			try {
				$this->render(implode('/', $path));
			} catch (MissingViewException $e) {
				if (Configure::read('debug')) {
					throw $e;
				}
				throw new NotFoundException();
			}
		}

		public function about( $slug = 'profile' )
		{

			$datas = $this->Page->find( 'first', array( 'conditions' => array( 'Page.type' => 'About Me', 'Page.slug' => $slug ), 'fields' => array( 'id', 'image', $this->field_title, 'url', $this->field_description ), 'order' => 'id DESC' ) );

			$module_title 	  = __( ABOUT );
			$title_for_layout = $datas[ 'Page' ][ 'title' ];
			$this->set( compact( 'datas', 'module_title', 'title_for_layout' ) );

		}

		public function faq()
		{

			$datas = $this->Page->find( 'all', array( 'conditions' => array( 'Page.type' => 'FAQ' ), 'fields' => array( 'id', 'image', $this->field_title, 'url', $this->field_description ) ) );
			$module_title = __( FAQ );
			$this->set( compact( 'datas', 'module_title' ) );
		}
        
        public function terms_conditions()
        {

			$datas = $this->Page->find( 'first', array( 'conditions' => array( 'Page.type' => 'Terms and Conditions' ), 'fields' => array( 'id', 'image', $this->field_title, 'url', $this->field_description ) ) );
			$module_title = __( TERMS ) . ' & ' . __( CONDITIONS );
			$this->set( compact( 'datas', 'module_title' ) );
        }

        public function health_info()
        {
			$datas = $this->Page->find( 'first', array( 'conditions' => array( 'Page.type' => 'Health Info' ), 'fields' => array( 'id', 'image', $this->field_title, 'url', $this->field_description ), 'order' => 'id DESC' ) );
			$module_title = __( 'Health Info' );
			$this->set( compact( 'datas', 'module_title' ) );        	
        }

        public function privacy_policy()
        {
			$datas = $this->Page->find( 'first', array( 'conditions' => array( 'Page.type' => 'Privacy Policy' ), 'fields' => array( 'id', 'image', $this->field_title, 'url', $this->field_description ), 'order' => 'id DESC' ) );
			$module_title = __( 'Privacy Policy' );
			$this->set( compact( 'datas', 'module_title' ) );        	
        }

		public function view( $slug = null )
		{
			$datas 		   = $this->Page->find( 'first', array( 'conditions' => array( 'Page.slug' => $slug ), 'fields' => array( 'id', 'image', $this->field_title, 'url', $this->field_description, 'type' ), 'order' => 'id DESC' ) );
			$sidebar_datas = $this->Page->find( 'all', array( 'conditions' => array( 'Page.type' => $datas[ 'Page' ][ 'type' ] ), 'fields' => array( 'id', $this->field_title, 'slug' ) ) );

			$module_title  = __( $datas[ 'Page' ][ 'title' ] );

			$this->set( compact( 'datas', 'module_title', 'sidebar_datas' ) );
		}

		public function career()
		{
			$datas = $this->Page->find( 'all', array( 'conditions' => array( 'Page.type' => 'Career' ), 'fields' => array( 'id', 'image', $this->field_title, 'url', $this->field_description ) ) );
			$module_title = __( 'Career' );
			$this->set( compact( 'datas', 'module_title' ) );        	

		}
        public function admin_index( $type = null )
        {
        	if ( $type != null )
        	{
	            $this->Paginator->settings = array( 'order' => array( 'title' => 'ASC' ), 'conditions' => array( 'type' => $type ) );        		
        	} else {
        		$this->Paginator->settings = array( 'order' => array( 'title' => 'ASC' ) );
        	}
            $datas = $this->Paginator->paginate( $this->model_name );
            $this->set( compact( 'datas', 'type' ) ); 
        }

        public function admin_add( $type = null )
        {

            if( $this->request->is( 'post' ) )
            {
                $this->Page->create();
                if( $this->Page->saveAssociated( $this->request->data ) )
                {
                    $this->Session->setFlash( __( MSG_DATA_SAVE_SUCCESS ), 'Bootstrap/flash-success' );
                    return $this->redirect( array( 'action' => ACTION_INDEX, $this->request->data[ 'Page' ][ 'type_text' ] ) );
                }
                else
                {
                    $this->Session->setFLash( __( MSG_DATA_SAVE_FAILED ), 'Bootstrap/flash-error' );
                }
                
            }
            $this->request->data[ 'Page' ][ 'type_text' ] = $type;

        }
        
        public function admin_edit( $id = null )
        {
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->Page->id = $id;
            if( !$this->Page->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            if( $this->request->is( 'post' ) || $this->request->is( 'put' ) )
            {
                if( $this->Page->save( $this->request->data ) )
                {
                    $this->Session->setFlash( __( MSG_DATA_EDIT_SUCCESS ), 'Bootstrap/flash-success' );
                    return $this->redirect( array( 'action' => ACTION_INDEX, $this->request->data[ 'Page' ][ 'type_text' ] ) );
                }
            }
            else
            {
                $this->request->data = $this->Page->read( null, $id );
                $this->request->data[ 'Page' ][ 'type_text' ] = $this->request->data[ 'Page' ][ 'type' ];
            }
        }
        
        public function admin_delete( $id = null )
        {
            
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            //$this->request->onlyAllow( 'post' );
            
            $this->Page->id = $id;
            if( !$this->Page->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            if( $this->Page->delete() )
            {
                $this->Session->setFlash( __( MSG_DATA_DELETE_SUCCESS ), 'Bootstrap/flash-success' );
                return $this->redirect( array( 'action' => ACTION_INDEX ) );
            }
            
            $this->Session->setFlash( __( MSG_DATA_DELETE_FAILED ), 'Bootstrap/flash-error' );
            return $this->redirect( array( 'action' => ACTION_INDEX ) );
        }
          
	}
