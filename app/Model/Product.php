<?php

    class Product extends AppModel
    {
        
        public $hasMany = array( 'ProductImage' => array( 'counterCache' => true ), 'ProductPrice' => array( 'counterCache' => true ) );
        public $belongsTo = array( 'User', 'ProductCategory', 'ProductType' );
        public $actsAs = array( 'Containable' );

        public function beforeSave( $options = array() )
        {
            $this->data[ $this->alias ][ 'created_date' ] = date( 'Y-m-d h:i:s' );
        	$this->data[ $this->alias ][ 'slug' ] = string_urlFriendly( $this->data[ $this->alias ][ 'name' ] );
        	return true;
        }
        
        public function beforeFind( $queryData ) {

            if(parent::beforeFind($queryData) !== false)
            {
                $defaultConditions         = array( $this->alias . '.status' => 0 );
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