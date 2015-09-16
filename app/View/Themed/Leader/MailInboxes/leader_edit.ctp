<?php
$data = $this->request->data[ 'MailInbox' ];
$tanggal_terima = date( 'd M Y', strtotime( $data[ 'received_date' ] ) );
$tanggal_penyelesaian = date( 'd M Y', strtotime( $data[ 'limit_date' ] ) );

?>
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

    <?php 
    echo $this->Form->create( $var_model, array( 'type' => 'file', 'autocomplete' => 'off', 'class' => 'form-horizontal', 'inputDefaults' => array( 'div' => false, 'label' => false ) ) );
    echo $this->Form->hidden( 'id' ). $this->Form->hidden( 'leader_id' ); 
    ?>
        <div class="row">
            <div class="col-sm-12 mb30">
                <p>Pesan ketua: </p>            
                <?= $this->Form->select( 'MailInbox.Assistant', $leader_assistants, array( 'multiple' => 'checkbox', 'class' => 'pler', 'label' => array( 'style' => 'margin-left: 10px' ), 'before' => '<span class="bangsar">' ) ); ?>
                <?= $this->Form->input( 'message_leader', array( 'required', 'class' => 'form-control'  ) );
                ?>
            </div>
            <div class="col-sm-12 mb30">
                <p>Pembantu Ketua, Kepada pimpinan unit: </p>

                <?php
                $no = 0;
                foreach( $leader_units as $key => $value ):
                    //echo $this->Form->checkbox( 'LeaderMail.' . $no . '.leader_id', array( 'value' => $key ) ) . " " . $value . " &nbsp; ";
                    ++$no;
                endforeach;
                echo $this->Form->input( 'MailInbox.Unit', array( 'options' => $leader_units, 'multiple' => 'checkbox', 'class' => 'checkbox block', 'disabled' ) );
                //echo $this->Form->input( 'MailInbox.Assistant', array( 'options' => $leader_assistants, 'multiple' => 'checkbox' ) );
                ?>
                <br>
                <p>Pesan pembantu ketua kepada unit: </p>
                <?= $this->Form->input( 'message_leader_assistant', array( 'required', 'class' => 'form-control', 'disabled' ) ); ?>                    
            </div>            
            <div class="col-sm-12">
                <div class="text-right btn-invoice">
                    <button class="btn btn-white btn-lg"><i class="fa fa-arrow-left mr5"></i> Kembali</button>
                    <button class="btn btn-primary btn-lg mr5"><i class="fa fa-send mr5"></i> Kirim Disposisi</button>
                </div>
            </div>
        </div>
    <?php
    echo $this->Form->end()
    ?>
        
        <div class="mb30"></div>
        
        <div class="well nomargin">
            Thank you for your business. Please make sure all cheques payable to <strong>ThemeForest Web Services, Inc.</strong> Account No. 54353535
        </div>
        
        
    </div><!-- panel-body -->
</div><!-- panel -->  