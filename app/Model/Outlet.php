<?php

    class Outlet extends AppModel
    {
        
        public $belongsTo = array( 'OutletCategory' => array( 'foreignKey' => 'category_id' ) );
        public $hasMany = array(
            'OutletImage' => array( 'counterCache' => true )
        );
        public $actsAs = array(
            //'Tree',
            'Upload.Upload' => array(
                'image' => array(
                    'thumbnailMethod' => 'php',
                    'thumbnailSizes' => array(
                        'medium' => '250x250',
                        'zoom' => '512x512',
                        'thumb' => '100x100'
                    )
                )
            )
        );  

        /*
        public function beforeSave( $options = array() )
        {

        	$this->data[ $this->alias ][ 'created_date' ] = date( 'Y-m-d h:i:s' );
            $this->data[ $this->alias ][ 'slug' ] = string_urlFriendly( $this->data[ $this->alias ][ 'title' ] );
        	return true;
        }


        public function beforeFind( $queryData ) {

            if(parent::beforeFind($queryData) !== false)
            {
                $defaultConditions         = array( 'OutletCategory.type' => 0 );
                if ( is_array( $queryData[ 'conditions' ] ) )
                {
                    $queryData[ 'conditions' ] = array_merge( $queryData[ 'conditions' ], $defaultConditions );
                }
            }
            return $queryData;
        }          
        */
        public function loadSidebarByCategory( $id = null ) // Load by category
        {
            return $this->OutletCategory->find( 'all', array( 
                //'fields' => array( 'ParentCategory.*' ),
                'conditions' => array( 'OutletCategory.parent_id' => null ),
                'contain' => array('ChildCategory' ),
                'order' => 'OutletCategory.name ASC'
            ) );
        }
    }

?>