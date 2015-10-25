<?php
$datas = $data[ 'Outbox' ];
/* $tanggal_terima = date( 'd M Y', strtotime( $data[ 'received_date' ] ) );
$tanggal_penyelesaian = date( 'd M Y', strtotime( $data[ 'limit_date' ] ) );*/

$picture_dir    = '/itpm/files/outbox/file/' . $datas[ 'id' ] . '/';
$picture        = $picture_dir . '' . $datas[ 'file' ];
?>
<div class="row mb10">
    <div class="col-md-3">
        <a href="<?= $picture ?>" data-rel="" class="btn btn-primary btn-block"><i class="fa fa-envelope-o"></i> &nbsp; Lihat Surat</a>
    </div>
    <div class="col-md-3 col-md-offset-6">
        <?php
            /*echo $this->Html->link(
                    __( TEXT_EDIT ),
                    array(
                        'controller' => $var_controller,
                        'action' => 'edit',
                        $datas[ 'id' ]
                    ),
                    array( 'class' => 'btn btn-white pull-right')
                );  */
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
                <p>Status leader: </p>
                <?php
                foreach( $data[ 'Leader' ] as $assistant ):
                    $status = text_approved( $assistant[ 'OutboxLeader' ][ 'status' ] );
                    echo $assistant[ 'name' ] . " ( " . $status . " ), &nbsp ";
                endforeach;
                ?>                
            </div>
            <div class="col-sm-12 mb30">
            	<p>Pesan: </p>
            	<i><?= $datas[ 'pesan' ] == null ? 'Tidak ada pesan' : $datas[ 'pesan' ] ?></i>
            </div>
            <?php
            if( $datas[ 'purpose' ] == 1 ){
            ?>
                <div class="col-sm-12">
                    <p>Status ketua: ( <?= text_approved( $datas[ 'leader_status' ] ) ?> )</p>
                </div>            
            <?php
            }
            ?>
        </div>        
    </div>
</div>
