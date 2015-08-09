

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
                <label class="col-sm-2 control-label"><?php echo __( 'Type' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'type_text', array( 'options' => $page_types, 'empty' => CHOOSE_OPTIONS, 'required', 'class' => 'form-control', 'placeholder' => __( 'Type' )  ) ); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Title in english' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'title', array( 'type' => 'text', 'required', 'class' => 'form-control', 'placeholder' => __( 'Title' )  ) ); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Title in indonesian' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'title_in_indonesian', array( 'type' => 'text', 'required', 'class' => 'form-control', 'placeholder' => __( 'Title' )  ) ); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Description in english' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'description', array( 'required', 'class' => 'form-control ckeditor', 'placeholder' => __( 'Description' )  ) ); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Description in indonesian' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'description_in_indonesian', array( 'required', 'class' => 'form-control ckeditor', 'placeholder' => __( 'Description' )  ) ); ?>
                </div>
            </div>            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Image' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('image', array( 'type' => 'file' ) ); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'URL' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'url', array( 'type' => 'text', 'class' => 'form-control', 'placeholder' => __( 'URL' )  ) ); ?>
                </div>
            </div>

        
    </div><!--/ .panel-body -->
        
    <div class="panel-footer">
        <?php echo $this->Form->input( 'user_id', array( 'type' => 'hidden', 'value' => $auth_id ) ); ?>
        <?php echo $this->Form->submit( __( 'Submit' ), array( 'class' => 'btn btn-primary', 'div' => false ) ); ?>
    </div><!--/ .panel-footer -->
            
    <?php echo $this->Form->end(); ?>
    
</div><!--/ .panel -->