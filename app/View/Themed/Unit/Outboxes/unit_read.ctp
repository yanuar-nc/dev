<?php
$data = $data[ 'Outbox' ];/*
$tanggal_terima = date( 'd M Y', strtotime( $data[ 'received_date' ] ) );
$tanggal_penyelesaian = date( 'd M Y', strtotime( $data[ 'limit_date' ] ) );*/

$picture_dir    = '/itpm/files/outbox/file/' . $data[ 'id' ] . '/';
$picture        = $picture_dir . '' . $data[ 'file' ];
?>
<div class="row mb10">
    <div class="col-md-3 col-md-offset-9">
        <a href="<?= $picture ?>" data-rel="prettyPhoto" class="btn btn-primary btn-block"><i class="fa fa-envelope-o"></i> &nbsp; Lihat Surat</a>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                
                <h5 class="lg-title mb10">Dari</h5>
                <p>Admin BAAK</p>
                <address>
                    <b>Perihal:</b> <br><?= $data[ 'perihal' ] ?>.<br>
                    <b>Lampiran:</b> <br><?= $data[ 'lampiran' ] ?><br>
                </address>
                
            </div><!-- col-sm-6 -->
            <div class="col-sm-6 text-right">
                <h5 class="subtitle mb10">No. Arsip</h5>
                <h4 class="text-primary"><?= $data[ 'no_arsip' ] ?></h4>
<!--                 
                <h5 class="subtitle mb10">Kepada</h5>
                <address>
                    <strong>ThemePixels, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    <abbr title="Phone">P:</abbr> (123) 456-7890
                </address>
                 -->
                <p><strong>Dibuat:</strong> <?= date( 'd M Y h:i:s', strtotime( $data[ 'created' ] ) ) ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 mb30">
            	<p>Pesan: </p>
            	<i><?= $data[ 'pesan' ] == null ? 'Tidak ada pesan' : $data[ 'pesan' ] ?></i>
            </div>
        </div>        
    </div>
</div>
