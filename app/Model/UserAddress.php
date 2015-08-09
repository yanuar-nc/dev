<?php

    App::uses( 'SimplePasswordHasher', 'Controller/Component/Auth' );

    class UserAddress extends AppModel
    {
        
        //public $hasMany = array( 'Transaction', 'TransactionReturn' );
        //public $hasMany = array( 'Product', 'Article', 'Page', 'TransactionCart', 'UserAddress' );
        public $belongsTo = array( 'District', 'User' );
        public $virtualFields = array( 'title_address' => 'CONCAT( UserAddress.recipient, ", ", UserAddress.address )' );
        
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