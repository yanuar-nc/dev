

<div class="panel panel-primary">
    
    <div class="panel-heading">
        
        <div class="panel-btns">
            <a href="#" class="minimize">&minus;</a>
        </div><!--/ .ppanel-btns -->
        
        <h4 class="panel-title"><?php echo __( TEXT_EDIT ); ?> <?php echo $module_title; ?></h4>
        
    </div><!--/ .panel-heading -->
    
    <?php echo $this->Form->create( $var_model, array( 'type' => 'file', 'autocomplete' => 'off', 'class' => 'form-horizontal', 'inputDefaults' => array( 'div' => false, 'label' => false ) ) );

       echo $this->Form->input( 'Outbox.id' );
     ?>
    
    <div class="panel-body">
        
        <div class="btn-toolbar">
        
            <div class="btn-group">
            
                <a href="javascript:history.go(-1);" class="btn btn-sm btn-white tooltips" data-toggle="tooltip" data-original-title="<?php echo __( TOOLTIP_PREVIOUS ); ?>">
                    <i class="fa fa-chevron-left"></i> &nbsp; <?php echo __( BTN_PREVIOUS ); ?>
                </a>
            
                <a href="<?php echo $this->here; ?>" class="btn btn-sm btn-white tooltips" data-toggle="tooltip" data-original-title="<?php echo __( TOOLTIP_REFRESH ); ?>">
                    <i class="fa fa-refresh"></i> &nbsp; <?php echo __( BTN_REFRESH ); ?>
                </a>
                
            </div><!--/ .btn-group -->
            
        </div><!--/ .btn-toolbar -->
        
        <br />
                
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'No. Arsip' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'no_arsip', array( 'type' => 'text', 'required', 'class' => 'form-control', 'placeholder' => __( 'No. Arsip' )  ) ); ?>
                </div>
            </div>  

            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Type' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'mail_type', array( 'required', 'class' => 'form-control', 'empty' => '-- Sifat --', 'placeholder' => __( 'Category' ), 'options' => $mail_types  ) ); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Lampiran' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'lampiran', array( 'type' => 'text', 'required', 'class' => 'form-control', 'placeholder' => __( 'Lampiran' )  ) ); ?>
                </div>
            </div>  
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Perihal' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'perihal', array( 'type' => 'text', 'required', 'class' => 'form-control', 'rows' => 3, 'placeholder' => __( 'Perihal' )  ) ); ?>
                </div>
            </div>  

            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Tujuan Surat' ) ?></label>
                <div class="col-sm-10">
                    <?= $this->Form->select( 'Outbox.Leader', $leaders_all, array( 'multiple' => 'checkbox', 'class' => 'pler', 'label' => array( 'style' => 'margin-left: 10px' ), 'before' => '<span class="bangsar">' ) ); ?>            
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'File sekarang' ); ?></label>
                <div class="col-sm-10">
                    <?php

                    if( isset( $this->request->data[ $var_model ][ 'file' ] ) ):

                    $rdata          = $this->request->data[ $var_model ];
                    
                    $picture_dir    = '/files/' . strtolower( $var_model ) . '/file/' . $rdata[ 'id' ] . '/';
                    $picture        = $picture_dir . '' . $rdata[ 'file' ];
                    $thumb          = $picture_dir . 'thumb_' . $rdata[ 'file' ];
                    
                    ?>
                    
                    <a href="<?php echo Router::url( $picture ); ?>" data-rel="prettyPhoto">
                        <?php echo $this->Html->image( $picture, array( 'class' => 'img-responsive img-thumbnail', 'alt' => '', 'width' => 100 ) ); ?>
                    </a>
                    <?php endif; ?>
                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'File' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'file', array( 'type' => 'file' ) ); ?>
                    <span class="help-block"><?php echo __( 'Leave it blank if no changes' ); ?></span>
                </div>
            </div>  
        
    </div><!--/ .panel-body -->
        
    <div class="panel-footer">
        <?php echo $this->Form->input( 'user_id', array( 'type' => 'hidden', 'value' => $auth_id ) ); ?>
        <?php echo $this->Form->submit( __( 'Submit' ), array( 'class' => 'btn btn-primary', 'div' => false ) ); ?>
    </div><!--/ .panel-footer -->
            
    <?php echo $this->Form->end(); ?>
    
</div><!--/ .panel -->