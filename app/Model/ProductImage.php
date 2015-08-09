<?php

    class ProductImage extends AppModel
    {
        
        public $belongsTo = array( 'Product' => array( 'counterCache' => true) );
        
		public $actsAs = array(
			//'Tree',
			'Upload.Upload' => array(
				'image' => array(
					'thumbnailMethod' => 'php',
					'thumbnailSizes' => array(
                        'medium' => '260x260',
						'zoom' => '512x512',
						'thumb' => '100x100'
					)
				)
			)
		);        
        
    }

?>