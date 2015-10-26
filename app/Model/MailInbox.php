<?php

    class MailInbox extends AppModel
    {
        
        public $belongsTo = array( 'Leader' );
        public $hasMany   = array( 'LeaderMail' );

        public $hasAndBelongsToMany = array(
            'Assistant' => array(
                'className' => 'Assistant',
                'joinTable' => 'leader_mails',
                'foreignKey' => 'mail_inbox_id',
                'associationForeignKey' => 'leader_id',
                'unique' => false,
                //'finderQuery' => 'SELECT * FROM leaders WHERE type=2'
                //'conditions' => array( 'Assistant.type' => 2 )
            ),
            'Unit' => array(
                'className' => 'Unit',
                'joinTable' => 'leader_mails',
                'foreignKey' => 'mail_inbox_id',
                'associationForeignKey' => 'leader_id',
                'unique' => false,
                //'conditions' => array( 'Unit.type' => 3 )
            )
        );
            
        public $useTable = 'mail_inbox';
		public $actsAs = array(
            'Containable',
			'Upload.Upload' => array(
				'file'
			)
		);

        public $validate = array(
            'file' => array(
                'pictureRule-1' => array (
                    'rule' => array('isValidMimeType', array( 'image/jpg', 'image/jpeg', 'image/png' ) ),
                    'message' => 'File is not a jpg/jpeg or png'
                ),
            )
        );        

        public function beforeSave($options = array()){
            foreach (array_keys($this->hasAndBelongsToMany) as $model){

                if(isset($this->data[$this->name][$model])){
                    //$this->data[$model][$model] = $this->data[$this->name][$model];
                    //unset($this->data[$this->name][$model]);
                }
                //$this->data[$model][$model][ 'created' ] = date( 'Y-m-d h:i:s' );
            }
            return true;
        }

        public function getMailTypes()
        {
            return array( 1 => 'Segera', 2 => 'Penting', 3 => 'Biasa', 4 => 'Rahasia', 5 => 'Pribadi' );
        }

        public function getTypeGenders()
        {
            return array( 'M' => __( 'Male' ), 'F' => __( 'Female' ) );
        }
    }

?>