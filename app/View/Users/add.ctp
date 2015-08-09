
<div class="panel panel-default">
    
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
                <label class="col-sm-2 control-label"><?php echo __( 'Username' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'username', array( 'class' => 'form-control', 'maxlength' => 16, 'required', 'class' => 'form-control', 'placeholder' => __( 'Username' )  ) ); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Password' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'password', array( 'class' => 'form-control', 'maxlength' => 16, 'required', 'class' => 'form-control', 'placeholder' => __( 'Password' ), 'type' => 'password'  ) ); ?>
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Re-type Password' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'rpassword', array( 'class' => 'form-control', 'maxlength' => 16, 'required', 'class' => 'form-control', 'placeholder' => __( 'Re-type Password' ), 'type' => 'password'  ) ); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Display Name' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'display_name', array( 'class' => 'form-control', 'maxlength' => 32, 'required', 'class' => 'form-control', 'placeholder' => __( 'Display Name' )  ) ); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'E-Mail' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'email', array( 'class' => 'form-control', 'maxlength' => 32, 'required', 'class' => 'form-control', 'placeholder' => __( 'E-Mail' ), 'type' => 'email'  ) ); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Bio' ); ?> <small>*optional</small></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'bio', array( 'class' => 'form-control', 'maxlength' => 140, 'class' => 'form-control', 'placeholder' => __( 'Describe about yourself' ), 'rows' => 5  ) ); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Gender' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'gender', array( 'class' => 'form-control', 'required', 'class' => 'form-control', 'options' => $genders ) ); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Birthdate' ); ?></label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <?php echo $this->Form->input( 'birthdate', array( 'class' => 'form-control', 'maxlength' => 10, 'class' => 'form-control', 'placeholder' => __( 'yyyy-mm-dd' ), 'id' => 'datepicker', 'type' => 'text' ) ); ?>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Address' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'address', array( 'class' => 'form-control', 'maxlength' => 140, 'class' => 'form-control', 'placeholder' => __( 'Address' ), 'rows' => 5  ) ); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'City' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'city', array( 'class' => 'form-control', 'maxlength' => 64, 'class' => 'form-control', 'placeholder' => __( 'City' ) ) ); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Postal Code' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'postal_code', array( 'class' => 'form-control', 'maxlength' => 8,   'class' => 'form-control', 'placeholder' => __( 'Postal Code' ), 'type' => 'number'  ) ); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Picture' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'picture', array( 'class' => 'form-control', 'class' => 'form-control', 'type' => 'file'  ) ); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Facebook<br /><small>*<?php echo __( 'optional' ); ?></small></label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon">facebook.com/</span>
                        <?php echo $this->Form->input( 'facebook_url', array( 'class' => 'form-control', 'maxlength' => 32, 'class' => 'form-control', 'placeholder' => 'johndoe' ) ); ?>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Twitter<br /><small>*<?php echo __( 'optional' ); ?></small></label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon">twitter.com/</span>
                        <?php echo $this->Form->input( 'twitter_url', array( 'class' => 'form-control', 'maxlength' => 32, 'class' => 'form-control', 'placeholder' => 'johndoe' ) ); ?>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Youtube<br /><small>*<?php echo __( 'optional' ); ?></small></label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon">youtube.com/</span>
                        <?php echo $this->Form->input( 'youtube_url', array( 'class' => 'form-control', 'maxlength' => 32, 'class' => 'form-control', 'placeholder' => 'johndoe' ) ); ?>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">LinkedIn<br /><small>*<?php echo __( 'optional' ); ?></small></label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon">linkedin.com/</span>
                        <?php echo $this->Form->input( 'linkedin_url', array( 'class' => 'form-control', 'maxlength' => 32, 'class' => 'form-control', 'placeholder' => 'johndoe' ) ); ?>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Pinterest<br /><small>*<?php echo __( 'optional' ); ?></small></label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon">pinterest.com/</span>
                        <?php echo $this->Form->input( 'pinterest_url', array( 'class' => 'form-control', 'maxlength' => 32, 'class' => 'form-control', 'placeholder' => 'johndoe' ) ); ?>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Instagram<br /><small>*<?php echo __( 'optional' ); ?></small></label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon">instagram.com/</span>
                        <?php echo $this->Form->input( 'instagram_url', array( 'class' => 'form-control', 'maxlength' => 32, 'class' => 'form-control', 'placeholder' => 'johndoe' ) ); ?>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Role' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'role', array( 'required', 'options' => $roles, 'class' => 'form-control' ) ); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Status' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'status', array( 'required', 'options' => $statuses, 'class' => 'form-control' ) ); ?>
                </div>
            </div>
        
    </div><!--/ .panel-body -->
        
    <div class="panel-footer">
        <?php echo $this->Form->submit( __( 'Submit' ), array( 'class' => 'btn btn-primary', 'div' => false ) ); ?>
    </div><!--/ .panel-footer -->
            
    <?php echo $this->Form->end(); ?>
    
</div><!--/ .panel -->