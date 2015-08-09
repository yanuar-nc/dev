<?php

    class HomeController extends AppController
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
            
        }
        
        public function index()
        {
            $this->loadModel( 'Product' );
            $this->loadModel( 'Article' );
            $this->loadModel( 'Banner' );
            $this->loadModel( 'ProductCategory' );

            $hell = $this->ProductCategory->find( 'all',
            array(
                'order' => array( 'ProductCategory.lft' => 'ASC' ),
                'recursive' => 1,
                'fields' => array( 'ProductCategory.id' ),
                'conditions' => array( 'ProductCategory.parent_id' => null )
                
            ) );
            $parent_id = array();
            foreach ( $hell as $key ) {
                $parent_id[] = $key[ 'ProductCategory' ][ 'id' ];
            }
            $product_categories = $this->ProductCategory->find( 'all',
            array(
                'order' => array( 'ProductCategory.lft' => 'ASC' ),
                'recursive' => -1,
                'conditions' => array( 'ProductCategory.parent_id' => $parent_id )
                
            ) );

            $latest_promos = $this->Product->find( 'all', array( 'conditions' => array( 'Product.promo' => 0 ), 'order' => 'Product.id DESC', 'limit' => 3 ) );
            $latest_news   = $this->Article->find( 'all', array( 'conditions' => array( 'Article.published_status' => 0 ), 'order' => 'Article.id DESC', 'limit' => 3 ) );
            $banners       = $this->Banner->find( 'all', array( 'conditions' => array( 'Banner.status' => 0, 'Banner.header' => 0 ), 'order' => 'Banner.modified DESC', 'limit' => 4 ) );

            $this->set( compact( 'latest_promos', 'latest_news', 'banners', 'product_categories' ) );
        }

        public function admin_index()
        {
            $this->set( compact( 
                'total_user_accounts', 
                'month_user_accounts', 
                'year_user_accounts', 
                'total_income', 
                'yesterday_income', 
                'week_income', 
                'total_articles',
                'yesterday_articles',
                'week_articles',
                'transaction_detail',
                'graphics'
            ) );
        }

        public function leader_index()
        {

        }
        
        public function assistant_index()
        {

        }

        public function unit_index()
        {
            
        }
    }

?>