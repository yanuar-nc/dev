<?php

    class Media extends AppModel
    {
    	public $useTable  = 'galleries';
        public $belongsTo = array( 'User', 'MediaCategory' => array( 'foreignKey' => 'category_id' ) );
        
        /*
        public $hasMany = array(
            'MediaImage' => array( 'counterCache' => true )
        );
        
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

        public function beforeFind( $queryData ) {

            if(parent::beforeFind($queryData) !== false)
            {
                $defaultConditions         = array( 'MediaCategory.type' => 3 );
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

        public function loadSidebar( $id = null )
        {
            return $this->find( 'all', array( 
                'conditions' => array( 'Media.id != ' => $id ), 
                'order'      => array( 'RAND()' ), 
                'fields'     => array( 'Media.id', 'Media.' . $this->field_title, 'Media.' . $this->field_description ),
                'contain'    => array( 'MediaCategory' => array( 'fields' => 'MediaCategory.id' ) ) 
            ) );

        }

	}

?>