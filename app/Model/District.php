<?php

    App::uses( 'SimplePasswordHasher', 'Controller/Component/Auth' );

    class District extends AppModel
    {
        
        //public $hasMany = array( 'Transaction', 'TransactionReturn' );
        //public $hasMany = array( 'Product', 'Article', 'Page', 'TransactionCart', 'UserAddress' );
        public $belongsTo = array( 'City', 'Province' );
        
    }

?>