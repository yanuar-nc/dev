<?php

    class Category extends AppModel
    {
        
        //public $hasMany = array( '' );
        
		public $actsAs = array(
			'Tree'
		);   

		public function beforeSave( $options = array() )     
		{
			$this->data[ $this->alias ][ 'slug' ] = string_urlFriendly( $this->data[ $this->alias ][ 'name' ] );			
			return true;
		}
        
    }

?>