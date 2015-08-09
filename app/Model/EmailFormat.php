<?php
App::uses( 'AppModel', 'Model' );
    class EmailFormat extends AppModel
    {

		public function beforeSave( $options = array() )     
		{
			$this->data[ $this->alias ][ 'type' ] = $this->data[ $this->alias ][ 'type_text' ];
			return true;
		}
        
    }

?>