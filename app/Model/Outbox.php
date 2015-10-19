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

    public function getMailTypes()
    {
        return array( 1 => 'Segera', 2 => 'Penting', 3 => 'Biasa', 4 => 'Rahasia', 5 => 'Pribadi' );
    }	
}
//538710684340