<?php

    class Article extends AppModel
    {
        
        public $hasMany = array( 'ArticleImage' => array( 'counterCache' => true ) ); 
        public $belongsTo = array( 'User', 'ArticleCategory' => array( 'foreignKey' => 'category_id' ) );
        
        public $actsAs = array(
            'Containable'
        );   

        public function beforeSave( $options = array() )
        {

            $this->data[ $this->alias ][ 'type' ]         = 0;
        	$this->data[ $this->alias ][ 'created_date' ] = date( 'Y-m-d h:i:s' );
            $this->data[ $this->alias ][ 'slug' ] = string_urlFriendly( $this->data[ $this->alias ][ 'title' ] );
        	return true;
        }

        public function beforeFind( $queryData ) {

            if(parent::beforeFind($queryData) !== false)
            {
                $defaultConditions         = array( 'ArticleCategory.type' => 0, 'Article.type' => 0 );
                if ( is_array( $queryData[ 'conditions' ] ) )
                {
                    $queryData[ 'conditions' ] = array_merge( $queryData[ 'conditions' ], $defaultConditions );
                } else {
                    $queryData[ 'conditions' ] = $defaultConditions ;
                }
            }
            return $queryData;
        }          
        
    }

?>