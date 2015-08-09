<?php

    class Gallery extends AppModel
    {
        public $belongsTo = array( 'User', 'GalleryCategory' => array( 'foreignKey' => 'category_id' ) );
        
        public $hasMany = array(
            'GalleryImage' => array( 'counterCache' => true )
        );
        /*
		public $actsAs = array(	
			'Upload.Upload' => array(
				'picture' => array(
					'thumbnailMethod' => 'php',
					'thumbnailSizes' => array(
                        'mini' => '110x77',
                        'wide' => '320x240',
						'zoom' => '512x512',
						'thumb' => '100x100'
					)
				)
			)
		);
		*/

	    public function beforeSave($options = array()) {  
            /*
	    	$type = $this->data[ $this->alias ][ 'type' ];
	    	if ( $type == 'NEW' ) {
	    		$name_type = 'baru';
	    	} else if ( $type == 'USED ') {
	    		$name_type = 'bekas';
	    	} else {
	    		$name_type = 'cbu';
	    	}

	    	$seo = 'Dijual Motor '.$this->data[ $this->alias ][ 'name' ].' '.$name_type.' '.$this->data[ $this->alias ][ 'year' ];
	        $this->data[ $this->alias ]['bike_seo'] = $this->seo_title( $seo );		
	       */
        }
        
        public function beforeFind( $queryData ) {

            if(parent::beforeFind($queryData) !== false)
            {
                $defaultConditions         = array( 'GalleryCategory.type' => 1 );
                if ( is_array( $queryData[ 'conditions' ] ) )
                {
                    $queryData[ 'conditions' ] = array_merge( $queryData[ 'conditions' ], $defaultConditions );
                } else {
                	$queryData[ 'conditions' ] = $defaultConditions;
                }
            }
            return $queryData;
        }        
        /**/

	}

?>