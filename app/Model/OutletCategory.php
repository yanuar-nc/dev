<?php
App::uses( 'AppModel', 'Model' );
    class OutletCategory extends AppModel
    {
        
        //public $hasMany = array( '' );
        public $useTable = 'categories';
        public $hasMany = array(
            'Outlet',
            'ChildCategory' => array(
                'className' => 'OutletCategory',
                'foreignKey' => 'parent_id',
                'dependent' => false,
                'conditions' => '',
                'fields' => array( 
                    'ChildCategory.id', 
                    'ChildCategory.name', 
                    'ChildCategory.name_in_indonesian', 
                    'ChildCategory.slug' 
                ),
                'order' => '',
                'limit' => '',
                'offset' => '',
                'exclusive' => '',
                'finderQuery' => '',
                'counterQuery' => ''
                )
            );

        public $belongsTo = array(
            'ParentCategory' => array(
                'className' => 'OutletCategory',
                'foreignKey' => 'parent_id',
                'conditions' => '',
                'fields' => array( 
                    'ParentCategory.id', 
                    'ParentCategory.name', 
                    'ParentCategory.name_in_indonesian', 
                    'ParentCategory.slug' 
                ),
                'order' => 'ParentCategory.name'
                )
            );

		public $actsAs = array(
			'Tree', 'Containable'
		);   

		public function beforeSave( $options = array() )     
		{
			$this->data[ $this->alias ][ 'type' ] = 2;
			$this->data[ $this->alias ][ 'slug' ] = string_urlFriendly( $this->data[ $this->alias ][ 'name' ] );			
			return true;
		}
        
        
        public function beforeFind( $queryData ) {

            if(parent::beforeFind($queryData) !== false)
            {
                $defaultConditions         = array( 'OutletCategory.type' => 2 );
                if ( is_array( $queryData[ 'conditions' ] ) )
                {
                    $queryData[ 'conditions' ] = array_merge( $queryData[ 'conditions' ], $defaultConditions );
                } else {
                    $queryData[ 'conditions' ] = $defaultConditions ;
                }
            }
            return $queryData;
        }        
    }

?>