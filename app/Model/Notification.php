<?php
App::uses('CakeSession', 'Model/Datasource');

    class Notification extends AppModel
    {
        public $hasMany = array(
            //'Transaction' => array( 'counterCache' => true ) 
            //'CompPhoto', 'CompVideo', 'HallOfSharp', 'CompStory', 'Notification', 'SharpUp'
        );

        public $belongsTo = array( 'Leader' );
        public $actsAs = array( 'Containable' ) ;

        public function addNotif( $content_id = null, $content = null, $action = null, $redirect = null, $mail_status = null )
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

            $leader_id = CakeSession::read("Auth.User.leader_id");
            $data   = array( 'Notification' );
            $data[ 'leader_id' ]  = $leader_id;
            $data[ 'content_id' ] = $content_id;
            $data[ 'content' ]    = $content;
            $data[ 'action' ]     = $action;
            $data[ 'redirect' ]   = $redirect;
            $data[ 'mail_status' ] = $mail_status;
            $data[ 'status' ]     = 0;
            $data[ 'created' ]    = date( 'Y-m-d H:i:s' );

            if( $this->save( $data ) )
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
                'mail_inboxes' => 'surat masuk/disposisi'
            );
        }
	}

?>