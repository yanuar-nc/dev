<?php

class Outbox extends AppModel 
{

	public $hasMany   = array( 
        'OutboxLeader', 
        'Notification' => array( 
            'foreignKey' => 'content_id', 
            'conditions' => array(
                'Notification.content' => 'outboxes'
            )
        ) 
    );
	public $actsAs    = array( 'Upload.Upload' => array( 'file' ) );
    public $hasAndBelongsToMany = array(
        'Leader' => array(
            'className' => 'Leader',
            'joinTable' => 'outbox_leaders',
            'foreignKey' => 'outbox_id',
            'associationForeignKey' => 'leader_id',
            'unique' => false,
            //'conditions' => array( 'Unit.type' => 3 )
        )
    );

    public $validate = array(
        'file' => array(
            'fileRule-1' => array (
                'rule' => array('isValidMimeType', 
                    array( 
                        'application/pdf', 
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' 
                    ) 
                ),
                'message' => 'Format file harus PDF atau Microsoft Word (*.doc, *.docx, *.pdf)'
            ),
        ),
        'Leader' => array(
            'rule' => array( 'multiple', array( 'min' => 1 ) ),
            'message' => 'Anda harus mengisi salah satu opsi diatas'
        )
    );        

    public function getMailTypes()
    {
        return array( 1 => 'Segera', 2 => 'Penting', 3 => 'Biasa', 4 => 'Rahasia', 5 => 'Pribadi' );
    }   

    public function getPurposes()
    {
        return array( 'Kedalam Instansi', 'Keluar Instansi' );
    }	
}
//538710684340