<?php

    class ArticleImage extends AppModel
    {
        
        public $belongsTo = array( 'Article' => array( 'counterCache' => true ) );
        
		public $validate = array(
			'image' => array(
				'pictureRule-1' => array (
					'rule' => array('isValidMimeType', array( 'image/jpg', 'image/jpeg' ) ),
					'message' => 'File is not a jpg/jpeg'
				),
				'pictureRule-2' => array (
					'rule' => array('isBelowMaxSize', 102400),
					'message' => '1mb is maximum file upload size'
				),
			)
		);        
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