<?php

    class ProductCategory extends AppModel
    {
        
        //public $hasMany = array( 'Product' );
        
		public $actsAs = array(
			'Tree', 'Containable',
			'Upload.Upload' => array(
                'cover' => array(
                    'thumbnailMethod' => 'php',
                    'thumbnailSizes' => array(
                        'medium' => '320x320',
                        'zoom' => '512x512',
                        'thumb' => '100x100'
                    )
                ),
                'image' => array(
                    'thumbnailMethod' => 'php',
                    'thumbnailSizes' => array(
                        'medium' => '320x320',
                        'zoom' => '512x512',
                        'thumb' => '100x100'
                    )
                ),
                'bg_image' => array(
                    'thumbnailMethod' => 'php',
                    'thumbnailSizes' => array(
                        'medium' => '320x320',
                        'zoom' => '512x512',
                        'thumb' => '100x100'
                    )
                )
			)
		);   

        public $belongsTo = array(
            'ParentCategory' => array(
                'className' => 'ProductCategory',
                'foreignKey' => 'parent_id',
                'conditions' => '',
                'fields' => array( 
                    'ParentCategory.id', 
                    'ParentCategory.name', 
                    'ParentCategory.name_in_indonesian', 
                    'ParentCategory.bg_image', 'ParentCategory.image',
                    'ParentCategory.slug',
                    'ParentCategory.parent_id',
                    'ParentCategory.cover'
                ),
                'order' => ''
                )
            );

        public $hasMany = array(
            //'Product',
            'ChildCategory' => array(
                'className' => 'ProductCategory',
                'foreignKey' => 'parent_id',
                'dependent' => false,
                'conditions' => '',
                'fields' => array( 
                    'ChildCategory.id', 
                    'ChildCategory.name', 
                    'ChildCategory.name_in_indonesian', 
                    'ChildCategory.bg_image', 'ChildCategory.image',
                    'ChildCategory.slug',
                    'ChildCategory.cover'
                ),
                'order' => '',
                'limit' => '',
                'offset' => '',
                'exclusive' => '',
                'finderQuery' => '',
                'counterQuery' => ''
                )
            );

		public function beforeSave( $options = array() )     
		{
			$this->data[ $this->alias ][ 'slug' ] = string_urlFriendly( $this->data[ $this->alias ][ 'name' ] );			
			return true;
		}
        
        public function beforeFind( $queryData ) {

            if(parent::beforeFind($queryData) !== false)
            {
                $defaultConditions         = array( $this->alias . '.status != 99' );
                if ( is_array( $queryData[ 'conditions' ] ) )
                {
                    $queryData[ 'conditions' ] = array_merge( $queryData[ 'conditions' ], $defaultConditions );
                }
            }
            return $queryData;
        }        
    }

?>