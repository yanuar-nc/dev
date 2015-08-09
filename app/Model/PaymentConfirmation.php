<?php

    class PaymentConfirmation extends AppModel
    {
        
        public $belongsTo = array( 'Transaction', 'Bank' );

    }

?>