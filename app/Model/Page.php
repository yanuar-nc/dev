<?php

    class Page extends AppModel
    {
        
        public $belongsTo = array( 'User' );
        
        public $actsAs = array(
            //'Tree',
            'Upload.Upload' => array(
                'image' => array(
                    'thumbnailMethod' => 'php',
                    'thumbnailSizes' => array(
                        'medium' => '320x320',
                        'zoom' => '512x512',
                        'thumb' => '100x100'
                    )
                )
            )
        );

        public function beforeSave( $options = array() )
        {
            $this->data[ $this->alias ][ 'type' ] = $this->data[ $this->alias ][ 'type_text' ];
        	$this->data[ $this->alias ][ 'created_date' ] = date( 'Y-m-d h:i:s' );
            $this->data[ $this->alias ][ 'slug' ] = string_urlFriendly( $this->data[ $this->alias ][ 'title' ] );
        	return true;
        }
        
    }

?>