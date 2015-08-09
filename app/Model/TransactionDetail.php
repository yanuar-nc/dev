<?php

    class TransactionDetail extends AppModel
    {

        public $belongsTo = array( 'Transaction', 'ProductPrice' );
        public $actsAs = array(
            'Containable'
        );   

        //public $hasMany = array( 'Book' );
        
        /*       
        public $hasAndBelongsToMany = array(
            'Book' => array(
                'className' => 'Book',
                'joinTable' => 'transactions_books',
                'foreignKey' => 'transaction_id',
                'associationForeignKey' => 'book_id',
                'unique' => 'keepExisting',
            )
        );        
        
        public function beforeSave( $options = array() ) {          

            foreach ( array_keys( $this->hasAndBelongsToMany ) as $model ){
                
                if( isset( $this->data[ $this->name ][ $model ] ) ) {

                    $this->data[ $model ][ $model ] = $this->data[ $this->name ][ $model ];
                    unset( $this->data[ $this->name ][ $model ] );

                }
            }
            return true;
        }   
        */            
    }

?>