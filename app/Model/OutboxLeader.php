<?php

class OutboxLeader extends AppModel
{

	public $belongsTo = array( 'Outbox' );
	public $hasAndBelonsToMany = array(
        'Leader' => array(
            'className' => 'Leader',
            'joinTable' => 'leader_mails',
            'foreignKey' => 'mail_inbox_id',
            'associationForeignKey' => 'leader_id',
            'unique' => false,
            //'finderQuery' => 'SELECT * FROM leaders WHERE type=2'
            //'conditions' => array( 'Leader.type' => 2 )
        ),	
	);
}