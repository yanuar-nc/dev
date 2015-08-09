<?php

    class Transaction extends AppModel
    {
        
        public $belongsTo = array( 'User', 'UserAddress' );
        public $hasMany = array( 'TransactionDetail', 'PaymentConfirmation' );
        //public $virtualFields = array( 'total' => 'SUM(grand_total)' );
        public $actsAs  = array( 'Containable' );

        public function beforeSave( $options = array() )
        {

        	$this->data[ $this->alias ][ 'created_date' ] = date( 'Y-m-d h:i:s' );
        	return true;
        }
        
    }

?>