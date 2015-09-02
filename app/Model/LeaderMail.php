<?php

    class LeaderMail extends AppModel
    {
        
        public $belongsTo = array( 'Leader', 'MailInbox' );
        
		public $actsAs = array(
            'Containable'
		);

        public $primaryKey = 'mail_inbox_id,leader_id';
    }

?>