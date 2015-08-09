<?php

    class GalleryImage extends AppModel
    {
        
        public $belongsTo = array( 'Gallery' => array( 'counterCache' => true) );
        
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
        
    }

?>