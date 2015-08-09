<?php

    /**
     * app/Model/Banner.php
     * Created by Falmesino Abdul Hamid(falmesino@gmail.com)
     */

    class Banner extends AppModel
    {
        
		public $actsAs = array(
			'Upload.Upload' => array(
				'picture' => array(
                    'thumbnailMethod' => 'php',
					'fields' => array(
						'dir' => 'picture_dir'
					),
					'thumbnailSizes' => array(
						'custom' => '1280x600',
                        'medium' => '360x360',
						'thumb' => '100x100'
					)
				)
			)
		);
        
        public function loadBanner( $limit = 5 )
        {
            $output = array();
            if( isset( $limit ) )
            {
                if( is_numeric( $limit ) )
                {
                    $output = $this->find( 
                        'all', 
                        array(
                            'conditions' => array(
                                $this->alias . '.status' => 0,
                                'DATE(' . $this->alias . '.date_start) <= ' => date( 'Y-m-d H:i:s' ),
                                'DATE(' . $this->alias . '.date_end) >= ' => date( 'Y-m-d H:i:s' ),
                            ),
                            'order' => array(
                                $this->alias . '.date_start' => 'DESC'
                            ),
                            'limit' => $limit
                        ) 
                    );
                }
            }
            return $output;
            
        }
        
    }

?>