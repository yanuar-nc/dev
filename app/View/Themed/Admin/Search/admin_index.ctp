<!-- REFINE -->
<div class="col-sm-4 col-md-3">

<?php
echo $this->Form->create( 'Search', array( 'url' => '/' . $auth_role . '/search/refine', 'type' => 'get', 'class' => 'form form-search', 'inputDefaults' => array( 'div' => false, 'label' => false ) ) );
?>
    <h4 class="md-title mb5">Data</h4>
    <?php echo $this->Form->input( 'data', array( 'class' => 'form-control', 'options' => $data_models, 'empty' => true, ) ) ?>

    <div class="mb20"></div>
    
    <h4 class="md-title mb5">Refine Results</h4>
    <div class="input-group">
        <?php echo $this->Form->input( 'keyword', array( 'class' => 'form-control', 'type' => 'search', 'placeholder' => 'Search' ) ) ?>
        <span class="input-group-addon"><i class="fa fa-search"></i></span>
    </div><!-- input-group -->

    
    <div class="mb20"></div>
        <?php echo $this->Form->button( __( BTN_SEARCH ), array( 'class' => 'btn btn-info btn-block' ) ) ?>
    <br>
    
    <small>Copyright &copy; 2015 STIKOM Binaniaga Bogor.</small>
<?php echo $this->Form->end() ?>
</div>

<!-- RESULTS -->
<div class="col-sm-6 col-md-9">
    <?php
    $hasil = count( $mail_inboxes ) + count( $outboxes );
    ?>
    <p>Has found <?= $hasil ?> rows from the search results "<?= $_GET[ 'keyword' ] ?>"
    (
    <?php 
    $time_end = microtime(true);
    $time = $time_end - $time_start;
    echo number_format( $time, 4, '.', '') 
    ?>    
    seconds
    )
    </p>
    <?php
    $search_data = empty( $this->request->data[ 'Search' ][ 'data' ] ) ? 'Outbox' : $this->request->data[ 'Search' ][ 'data' ];

    ?>
    <ul class="nav nav-tabs nav-primary nav-metro tab-content-metro">
        <li class="<?php echo $search_data == 'Outbox' ? 'active' : null ?>"><a data-toggle="tab" href="#tab1"><?= __( 'Surat Keluar' ) ?></a></li>
        <li class="<?php echo $search_data == 'MailInbox' ? 'active' : null ?>"><a data-toggle="tab" href="#tab2"><?= __( 'Surat Masuk/Disposisi' ) ?></a></li>
    </ul>
    <div class="tab-content tab-content-primary">
        <div id="tab1" class="tab-pane <?php echo $search_data == 'Outbox' ? 'active' : null ?>">
            <?php
            foreach ( $outboxes as $data  ) {
            
                $row = $data[ 'Outbox' ];
                $created   = date( 'D, d F Y', strtotime( $row[ 'created' ] ) );
            ?>
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">
                        <?php echo $this->Html->link( $row[ 'perihal' ] . ' / ' . $mail_types[ $row[ 'mail_type' ] ], array( 'controller' => 'outboxes', 'action' => 'read', $row[ 'id' ] ) ) ?>
                        </h4>
                        <small class="media-desc">
                            <i class="fa fa-envelope"></i> &nbsp; No. Surat: <?= $row[ 'no_surat' ] ?>&nbsp; | &nbsp; 
                            <i class="fa fa-calendar"></i> &nbsp; Tujuan: <?= $getPurposes[ $row[ 'purpose' ] ] ?> &nbsp; | &nbsp; 
                            <i class="fa fa-user"></i> &nbsp; Dibuat: <?= $created ?>
                        </small>
                  </div>
                </div><!-- media -->
            <?php
            }
            ?>
              
        </div><!-- tab-pane -->
      
        <div id="tab2" class="widget-bloglist tab-pane <?php echo $search_data == 'MailInbox' ? 'active' : null ?>">
            <div class="media">
            <?php
            foreach ( $mail_inboxes as $data  ) {
            
                $row  = $data[ 'MailInbox' ];
                $status      = $row[ 'leader_status' ];

                $publish_date = date('d M Y h:i:s', strtotime( $row[ 'created' ] ) );

            ?>
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">
                        <?php echo $this->Html->link( $row[ 'perihal' ] . '/' . $mail_types[ $row[ 'mail_type' ] ], array( 'controller' => 'mail_inboxes', 'action' => 'read', $row[ 'id' ] ) ) ?>
                        </h4>
                        <small class="media-desc">
                            <i class="fa fa-envelope"></i> &nbsp; No. Surat: <?= $row[ 'no_surat' ] ?>&nbsp; | &nbsp; 
                            <i class="fa fa-calendar"></i> &nbsp; Dibuat: <?= $publish_date ?> &nbsp; | &nbsp; <i class="fa fa-user"></i> &nbsp; Dari: &nbsp; <?= $row[ 'asal_surat' ]; ?> &nbsp;
                        </small>
                  </div>
                </div><!-- media -->
            <?php
            }
            ?>

            </div><!-- media -->
        
        </div><!-- tab-pane -->
      
    </div><!-- tab-content -->
    
    <br>
</div>