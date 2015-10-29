<?php
App::uses('CakeSession', 'Model/Datasource');

    class Notification extends AppModel
    {
        public $hasMany = array(
            //'Transaction' => array( 'counterCache' => true ) 
            //'CompPhoto', 'CompVideo', 'HallOfSharp', 'CompStory', 'Notification', 'SharpUp'
        );

        public $belongsTo = array( 'Sender' => array( 'className' => 'Leader', 'foreignKey' => 'sender_id' ), 'Receiver' => array( 'className' => 'Leader', 'foreignKey' => 'receiver_id' ) );
        public $actsAs = array( 'Containable' ) ;
    
        public function addNotif( $datas = array() )
        {
            /*
            if( !$id )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            
            $this->id = $id;
            if( !$this->exists() )
            {
                throw new NotFoundException( __( MSG_DATA_NOT_FOUND ) );
            }
            */
/*
            $leader_id = CakeSession::read("Auth.User.leader_id");
            $data   = array( 'Notification' );
            $data[ 'leader_id' ]  = $leader_id;
            $data[ 'content_id' ] = $content_id;
            $data[ 'content' ]    = $content;
            $data[ 'action' ]     = $action;
            $data[ 'redirect' ]   = $redirect;
            $data[ 'mail_status' ] = $mail_status;
            $data[ 'role' ]        = $role;
            $data[ 'status' ]     = 0;
            $data[ 'created' ]    = date( 'Y-m-d H:i:s' );
*/
            if( $this->saveAll( $datas ) )
            {
                
                return true;
            }
            else
            {
                return false;
            }
            
        }

        public function getTextNotification()        
        {
            return array(
                'not_approved' => 'tidak menyetujui',
                'approved' => 'menyetujui',
                'outboxes' => 'surat keluar',
                'mail_inboxes' => 'surat masuk/disposisi',
                'add' => 'mingirimkan'
            );
        }
	}

?>