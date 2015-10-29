<?php
$datas = $data[ 'Outbox' ];
/* $tanggal_terima = date( 'd M Y', strtotime( $data[ 'received_date' ] ) );
$tanggal_penyelesaian = date( 'd M Y', strtotime( $data[ 'limit_date' ] ) );*/

$picture_dir    = '/itpm/files/outbox/file/' . $datas[ 'id' ] . '/';
$picture        = $picture_dir . '' . $datas[ 'file' ];
/*$data[ 'leader_id' ]  = $leader_id;
$data[ 'content_id' ] = $content_id;
$data[ 'content' ]    = $content;
$data[ 'action' ]     = $action;
$data[ 'redirect' ]   = $redirect;
$data[ 'mail_status' ] = $mail_status;
$data[ 'role' ]        = $role;
$data[ 'status' ]     = 0;
$data[ 'created' ]    = date( 'Y-m-d H:i:s' );
$array1 = array( 'leader_id' => 1, 
                 'content_id' => 2, 
                 'content' => 'outboxes',
                 'action' => 'approved',
                 'redirect' => 'read',
                 'mail_status' => 2,
                 'role' => 'unit'
                 );
*/

?>
<div class="row mb10">
    <div class="col-md-3">
        <a href="<?= $picture ?>" data-rel="" class="btn btn-primary btn-block"><i class="fa fa-envelope-o"></i> &nbsp; Lihat Surat</a>
    </div>
    <div class="col-md-3 col-md-offset-6">
        <?php
        foreach( $data[ 'OutboxLeader' ] as $outbox_leader )
        {
            if( $outbox_leader[ 'leader_id' ] == $auth_data[ 'leader_id' ] )
            {
                if( $outbox_leader[ 'status' ] == 0 )
                    echo $this->Html->link(
                            __( TEXT_APPROVED ),
                            array(
                                'controller' => $var_controller,
                                'action' => 'approved',
                                $datas[ 'id' ]
                            ),
                            array( 'class' => 'btn btn-white pull-right')
                        );   
                else
                    echo $this->Html->link(
                            __( TEXT_NOT_APPROVED ),
                            array(
                                'controller' => $var_controller,
                                'action' => 'not_approved',
                                $datas[ 'id' ]
                            ),
                            array( 'class' => 'btn btn-white pull-right')
                        );   

            }
        }
        ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                
                <h5 class="lg-title mb10">Dari</h5>
                <p>Admin BAAK</p>
                <address>
                    <b>Perihal:</b> <br><?= $datas[ 'perihal' ] ?>.<br>
                    <b>Lampiran:</b> <br><?= $datas[ 'lampiran' ] ?><br>
                </address>
                
            </div><!-- col-sm-6 -->
            <div class="col-sm-6 text-right">
                <h5 class="subtitle mb10">No. Surat</h5>
                <h4 class="text-primary"><?= $datas[ 'no_surat' ] ?></h4>
<!--                 
                <h5 class="subtitle mb10">Kepada</h5>
                <address>
                    <strong>ThemePixels, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    <abbr title="Phone">P:</abbr> (123) 456-7890
                </address>
                 -->
                <p><strong>Dibuat:</strong> <?= date( 'd M Y h:i:s', strtotime( $datas[ 'created' ] ) ) ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 mb30">
                <p>Pesan: </p>
                <i><?= $datas[ 'pesan' ] == null ? 'Tidak ada pesan' : $datas[ 'pesan' ] ?></i>
            </div>
            <div class="col-sm-12">
            <?php if( $datas[ 'purpose' ] == 1 ): ?>
                    <p>Status ketua: ( <?= text_approved( $datas[ 'leader_status' ] ) ?> )</p>
            <?php else: ?>
                <?php 
                    echo $this->Form->create( $var_model, array( 'type' => 'file', 'autocomplete' => 'off', 'class' => 'form-horizontal', 'inputDefaults' => array( 'div' => false, 'label' => false ) ) );

                    echo $this->Form->input( 'Outbox.id' );
                ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo __( 'Tujuan Surat' ) ?></label>
                    <div class="col-sm-10">
                        <?= $this->Form->select( 'Outbox.Leader', $units, array( 'multiple' => 'checkbox', 'class' => 'checkbox', 'label' => array( 'style' => 'margin-left: 10px' ), 'before' => '<span class="bangsar">' ) ); ?>            
                    </div>
                </div>                
                <hr>
                <?php echo $this->Form->submit( __( 'Submit' ), array( 'class' => 'btn btn-primary pull-right', 'div' => false ) ); ?>
                <?php

                    echo $this->Form->end();
                ?>
            <?php endif; ?>
            </div>
        </div>        
    </div>
</div>
