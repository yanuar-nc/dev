<?php

    class ProductType extends AppModel
    {
        
        //public $hasMany = array( 'Product' );
        
		public $actsAs = array(
			'Tree', 'Containable',
			'Upload.Upload' => array(
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

        public $hasMany = array( 'Product' );

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