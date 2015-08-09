<?php
App::uses( 'AppModel', 'Model' );
    class MediaCategory extends AppModel
    {
        
        //public $hasMany = array( '' );
        public $useTable = 'categories';

		public $actsAs = array(
			'Tree'
		);   

		public function beforeSave( $options = array() )     
		{
			$this->data[ $this->alias ][ 'type' ] = 3;
			$this->data[ $this->alias ][ 'slug' ] = string_urlFriendly( $this->data[ $this->alias ][ 'name' ] );			
			return true;
		}
        
        
        public function beforeFind( $queryData ) {

            if(parent::beforeFind($queryData) !== false)
            {
                $defaultConditions         = array( 'MediaCategory.type' => 3 );
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