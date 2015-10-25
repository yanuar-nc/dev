

<div class="panel panel-primary">
    
    <div class="panel-heading">
        
        <div class="panel-btns">
            <a href="#" class="minimize">&minus;</a>
        </div><!--/ .ppanel-btns -->
        
        <h4 class="panel-title"><?php echo __( TEXT_ADD ); ?> <?php echo $module_title; ?></h4>
        
    </div><!--/ .panel-heading -->
    
    <?php echo $this->Form->create( $var_model, array( 'type' => 'file', 'autocomplete' => 'off', 'class' => 'form-horizontal', 'inputDefaults' => array( 'div' => false, 'label' => false ) ) ); ?>  
    
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
                <label class="col-sm-2 control-label"><?php echo __( 'Ketua' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'leader_id', array( 'required', 'class' => 'form-control', 'placeholder' => __( 'Category' ), 'options' => $leaders  ) ); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'No. Surat' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'no_surat', array( 'type' => 'text', 'required', 'class' => 'form-control', 'placeholder' => __( 'No. Surat' ), 'readonly'  ) ); ?>
                </div>
            </div>          
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'No. Arsip' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'no_arsip', array( 'type' => 'text', 'required', 'class' => 'form-control', 'placeholder' => __( 'No. Arsip' ), 'readonly'  ) ); ?>
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
                <label class="col-sm-2 control-label"><?php echo __( 'Asal Surat' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'asal_surat', array( 'type' => 'text', 'required', 'class' => 'form-control', 'placeholder' => __( 'Asal Surat' )  ) ); ?>
                </div>
            </div>            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Tanggal Terima' ); ?></label>
                <div class="row">
                    <div class="col-md-1">
                        <?= $this->Form->day( 'received_date', array( 'required', 'class' => 'form-control', 'empty' => 'Tanggal'  ) ); ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->month( 'received_date', array( 'required', 'class' => 'form-control', 'empty' => 'Bulan' ) ); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $this->Form->year( 'received_date', 2000, date( 'Y' ), array( 'required', 'class' => 'form-control', 'empty' => 'Tahun' ) ); ?>
                    </div>
                </div> 
            </div>    
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Tanggal Penyelesaian' ); ?></label>
                <div class="row">
                    <div class="col-md-1">
                        <?= $this->Form->day( 'limit_date', array( 'required', 'class' => 'form-control', 'empty' => 'Tanggal'  ) ); ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->month( 'limit_date', array( 'required', 'class' => 'form-control', 'empty' => 'Bulan' ) ); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $this->Form->year( 'limit_date', 2000, date( 'Y' ), array( 'required', 'class' => 'form-control', 'empty' => 'Tahun' ) ); ?>
                    </div>
                </div>
            </div>            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'File' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'file', array( 'type' => 'file' ) ); ?>
                </div>
            </div>  
        
    </div><!--/ .panel-body -->
        
    <div class="panel-footer">
        <?php echo $this->Form->input( 'user_id', array( 'type' => 'hidden', 'value' => $auth_id ) ); ?>
        <?php echo $this->Form->submit( __( 'Submit' ), array( 'class' => 'btn btn-primary', 'div' => false ) ); ?>
    </div><!--/ .panel-footer -->
            
    <?php echo $this->Form->end(); ?>
    
</div><!--/ .panel -->