<div class="btn-group btn-group-option">

    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-caret-down"></i>
    </button>
    <ul class="dropdown-menu pull-right" role="menu">
        <li>
            <?php echo $this->Html->link( '<i class="glyphicon glyphicon-log-out"></i> ' . __( 'Sign Out' ), 
                    array( 'controller' => 'users', 
                           'action' => 'logout', 
                           'admin' => false,
                           'leader' => false,
                           'unit' => false,
                           'assistant' => false ), 
                    array( 'escape' => false ) ); 
            ?>
        </li>
    </ul>
</div><!-- btn-group -->