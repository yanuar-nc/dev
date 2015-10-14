<?php
$datas = $data;
$data  = $datas[ 'MailInbox' ];
$tanggal_terima = date( 'd M Y', strtotime( $data[ 'received_date' ] ) );
$tanggal_penyelesaian = date( 'd M Y', strtotime( $data[ 'limit_date' ] ) );

$picture_dir    = '/itpm/files/mail_inbox/file/' . $data[ 'id' ] . '/';
$picture        = $picture_dir . '' . $data[ 'file' ];
?>
<div class="row mb10">

    <div class="col-md-3">
        
        <a href="<?= $picture ?>" data-rel="prettyPhoto" class="btn btn-primary btn-block"><i class="fa fa-envelope-o"></i> &nbsp; Lihat Surat</a>
    </div>
    <div class="col-md-3 col-md-offset-6">
        <?php
            echo $this->Html->link(
                    __( TEXT_EDIT ),
                    array(
                        'controller' => $var_controller,
                        'action' => 'edit',
                        $data[ 'id' ]
                    ),
                    array( 'class' => 'btn btn-white pull-right')
                );  
        ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                
                <h5 class="lg-title mb10">Dari</h5>
                <p><?= $data[ 'asal_surat' ] ?></p>
                <address>
                    <b>Perihal:</b> <br><?= $data[ 'perihal' ] ?>.<br>
                    <b>Lampiran:</b> <br><?= $data[ 'lampiran' ] ?><br>
                </address>
                
            </div><!-- col-sm-6 -->
            
            <div class="col-sm-6 text-right">
                <h5 class="subtitle mb10">No. Surat / No. Arsip</h5>
                <h4 class="text-primary"><?= $data[ 'no_surat' ] ?> / <?= $data[ 'no_arsip' ] ?></h4>
<!--                 
                <h5 class="subtitle mb10">Kepada</h5>
                <address>
                    <strong>ThemePixels, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    <abbr title="Phone">P:</abbr> (123) 456-7890
                </address>
                 -->
                <p><strong>Tanggal Terima:</strong> <?= $tanggal_terima ?></p>
                <p><strong>Tanggal Penyelesaian:</strong> <?= $tanggal_penyelesaian ?></p>
                
            </div>
        </div><!-- row -->

        <div class="row">
            <div class="col-sm-12">

                <p>Pesan ketua: </p>
                <?= $this->Form->textarea( 'message_leader', array( 'required', 'rows' => 5, 'class' => 'form-control mb30', 'disabled', 'value' => $data[ 'message_leader' ]  ) );
                ?>
                <p>Status pembantu ketua: </p>
                <?php
                foreach( $datas[ 'Assistant' ] as $assistant ):
                    $status = text_approved( $assistant[ 'LeaderMail' ][ 'status' ] );
                    echo $assistant[ 'name' ] . " ( " . $status . " ), &nbsp ";
                endforeach;
                ?>
            </div>
            <div class="col-sm-12">
            <hr>
            </div>
            <div class="col-sm-12 mb30">

                <p>Pembantu Ketua, Kepada pimpinan unit: </p>
                <?= $this->Form->textarea( 'message_leader_assistant', array( 'required', 'rows' => 5, 'class' => 'form-control mb30', 'disabled', 'value' => $data[ 'message_leader_assistant' ]  ) );
                ?>
                <p>Status pembantu ketua: </p>
                <?php
                foreach( $datas[ 'Unit' ] as $assistant ):
                    $status = text_approved( $assistant[ 'LeaderMail' ][ 'status' ] );
                    echo $assistant[ 'name' ] . " ( " . $status . " ), &nbsp ";
                endforeach;
                ?>
            </div>           
            <div class="col-sm-12">
                <div class="text-right btn-invoice">
                    <button class="btn btn-white btn-lg" onclick="javascript:history.go(-1);"><i class="fa fa-arrow-left mr5"></i> Kembali</button>
                    <button class="btn btn-primary btn-lg mr5"><i class="fa fa-send mr5"></i> Kirim Disposisi</button>
                </div>
            </div>
        </div>
    <?php
    echo $this->Form->end()
    ?>
        
        <div class="mb30"></div>
        
        <div class="well nomargin">
            <center>Stikom Binaniaga Bogor.</center>
        </div>
        
        
    </div><!-- panel-body -->
</div><!-- panel -->  