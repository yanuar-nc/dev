dunia
<?php
echo __( 'previous' );
echo $this->Html->link('English', array('language'=>'eng'));
echo $this->Html->link('Indonesia <br>', array('language'=>'ind'));

echo $this->Html->link(
    '<i class="fa fa-cogs"></i>&nbsp;<span>' . __( TEXT_USER ) . '</span>',
    array(
        'controller' => 'users',
        'action' => 'index',
        'language' => 'ind',
        'admin' => false
    ),
    array(
        'escape' => false,
        'class' => ''
    )
); 
echo __( $results[ 'Page']['description'] );
?>