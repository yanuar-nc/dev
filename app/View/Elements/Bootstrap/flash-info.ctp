<?php

	/**
	 * app/View/Elements/admin/flash-info.ctp
	 * Created by Falmesino Abdul Hamid(falmesino@gmail.com)
	 */

?>

<div class="row">
    
    <div class="col-lg-12">
    
        <div class="alert alert-info alert-block fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
            	<i class="fa fa-times"></i>
            </button>
            <h4><i class="glyphicon glyphicon-ok-sign"></i> <?php echo __( 'Attention!' ); ?></h4>
            <p><?php echo __( $message ); ?></p>
        </div><!--/ .alert -->
        
    </div><!--/ .col-lg-12 -->
    
</div><!--/ .row -->