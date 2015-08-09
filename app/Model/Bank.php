<?php

    class Bank extends AppModel
    {

        public $virtualFields = array( 'dropdown_name' => 'CONCAT( Bank.bank_name, " - ", Bank.id, " - ", Bank.bank_account_name )' );
        
    }

?>