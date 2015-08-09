<?php

    class ProductPrice extends AppModel
    {
        
        public $belongsTo = array( 'Product' => array( 'counterCache' => true) );      
		public $actsAs = array(
			'Containable'
		);   

    }

?>