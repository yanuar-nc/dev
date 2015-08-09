<?php

    App::uses( 'SimplePasswordHasher', 'Controller/Component/Auth' );

    class User extends AppModel
    {
        
        //public $hasMany = array( 'Transaction', 'TransactionReturn' );
        //public $hasMany = array( 'Product', 'Article', 'Page', 'Transaction', 'UserAddress' );
        
		public $actsAs = array(
            'Containable',
			/*'Upload.Upload' => array(
				'picture' => array(
					'fields' => array(
						'dir' => 'picture_dir'
					),
					'thumbnailSizes' => array(
						'zoom' => '512x512',
						'thumb' => '100x100'
					),
                    'thumbnailMethod' => 'php'
				)
			)*/
		);
        
        public function beforeSave( $options = array() )
        {
/*
            $passwordHasher = new SimplePasswordHasher();
            if( isset( $this->data[ $this->alias ][ 'password' ] ) )
            {
                $this->data[ $this->alias ][ 'password' ] = $passwordHasher->hash( $this->data[ $this->alias ][ 'password' ] );
            }
*/
            return true;
        }
        
        public function beforeFind( $queryData ) {
            /*
            if(parent::beforeFind($queryData) !== false)
            {
                $defaultConditions         = array( $this->alias . '.role !=' => 'fuckingshit' );
                if ( is_array( $queryData[ 'conditions' ] ) )
                {
                    $queryData[ 'conditions' ] = array_merge( $queryData[ 'conditions' ], $defaultConditions );
                } else {
                    $queryData[ 'conditions' ] = $defaultConditions ;
                }
            }
            return $queryData;
            */
        } 

        public function getTypeRoles()
        {
            return array( 'admin' => 'Administrator', 'leader' => 'Leader', 'assistant' => 'Assistant', 'unit' => 'Unit' );
        }

        public function getTypeGenders()
        {
            return array( 'M' => __( 'Male' ), 'F' => __( 'Female' ) );
        }
    }

?>