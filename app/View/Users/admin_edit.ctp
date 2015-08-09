
<div class="panel panel-default">
    
    <div class="panel-heading">
        
        <div class="panel-btns">
            <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
        </div><!--/ .ppanel-btns -->
        
        <h4 class="panel-title"><?php echo __( TEXT_EDIT ); ?> <?php echo $module_title; ?></h4>
        
    </div><!--/ .panel-heading -->
    
    <?php echo $this->Form->create( $var_model, array( 'action' => ACTION_EDIT, 'type' => 'file', 'autocomplete' => 'off', 'class' => 'form-horizontal', 'inputDefaults' => array( 'div' => false, 'label' => false ) ) ); ?>  
    
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
                <label class="col-sm-2 control-label"><?php echo __( 'Name' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'name', array( 'class' => 'form-control', 'maxlength' => 32, 'required', 'class' => 'form-control', 'placeholder' => __( 'Name' )  ) ); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Birthday' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'birthday_date', array( 'dateFormat' => 'D M Y h:i:s', 'minYear' => date( 'Y' ) - 77, 'maxYear' => date( 'Y' ) - 18, 'required', 'class' => 'form-control','style' => 'width: auto; display: inline; margin: 0 10px' ) ); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( ' Old Password' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'opassword', array( 'class' => 'form-control', 'maxlength' => 16, 'class' => 'form-control', 'placeholder' => __( 'Password' ), 'type' => 'password'  ) ); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'New Password' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'npassword', array( 'class' => 'form-control', 'maxlength' => 16, 'class' => 'form-control', 'placeholder' => __( 'New Password' ), 'type' => 'password'  ) ); ?>
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Re-type New Password' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'rnpassword', array( 'class' => 'form-control', 'maxlength' => 16, 'class' => 'form-control', 'placeholder' => __( 'Re-type Password' ), 'type' => 'password'  ) ); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'E-Mail' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'email', array( 'class' => 'form-control', 'maxlength' => 32, 'required', 'class' => 'form-control', 'placeholder' => __( 'E-Mail' ), 'type' => 'email'  ) ); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Gender' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'gender', array( 'class' => 'form-control', 'required', 'class' => 'form-control', 'options' => $genders ) ); ?>
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
                <label class="col-sm-2 control-label"><?php echo __( 'Current Picture' ); ?></label>
                <div class="col-sm-10">
                    <?php
                        if( !is_array( $this->request->data[ $var_model ][ 'picture' ] ) ):
                            $picture_dir = '/files/' . strtolower( $var_model ) . '/picture/';
                            $picture_dir .= $this->request->data[ $var_model ][ 'picture_dir' ] . '/';
                            $picture    = $picture_dir . $this->request->data[ $var_model ][ 'picture' ];
                            $thumb      = $picture_dir . 'thumb_' . $this->request->data[ $var_model ][ 'picture' ];
                    ?>
                    <a href="<?php echo Router::url( $picture ); ?>" data-rel="prettyPhoto">
                        <?php echo $this->Html->image( $thumb, array( 'class' => 'img-responsive img-thumbnail', 'alt' => '' ) ); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'New Picture' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'picture_dir', array( 'type' => 'hidden' ) ); ?>
                    <?php echo $this->Form->input( 'picture', array( 'class' => 'form-control', 'class' => 'form-control', 'type' => 'file'  ) ); ?>
                </div>
            </div>
            
            <?php
            if ( $auth_role != '2f241db770519cd98aa5f8020f642cbc' ):
                ?>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo __( 'Role' ); ?></label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input( 'role', array( 'required', 'options' => $roles, 'class' => 'form-control' ) ); ?>
                </div>
            </div>
            <?php
            endif;
            ?>
            
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
    
</div><!--/ .panel -->