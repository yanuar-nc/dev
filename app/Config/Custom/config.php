<?php

    // Functions
    include_once( 'functions.php' );

    // Dictionary file
    include_once( 'Dictionaries/default.php' );

    // Action constants
    define( 'ACTION_INDEX',     'index' );
    define( 'ACTION_ADD',       'add' );
    define( 'ACTION_EDIT',      'edit' );
    define( 'ACTION_DELETE',    'delete' );
    define( 'ACTION_ENABLE',    'enable' );
    define( 'ACTION_DISABLE',   'disable' );
    define( 'ACTION_VIEW',      'view' );
    

    define( 'ACTION_MARK_AS_READ',      'read' );
    define( 'ACTION_MARK_AS_UNREAD',    'unread' );
    define( 'ACTION_REPAIR',            'repair' );

    define( 'ACTION_MOVE_UP',   'move_up' );
    define( 'ACTION_MOVE_DOWN', 'move_down' );

    // Administrator Layout
    define( 'THEME_ADMIN',     'Administrator' );
    define( 'LAYOUT_ADMIN',    'default' );

    define( 'THEME_DEFAULT',     'Administrator' );
    define( 'LAYOUT_DEFAULT',    'default' );
    // Put your own configurations below

    define( 'ALLOWED_EMPTIED', 'Allowed emptied' );
    define( 'VIEW_ALL',        'View All' );
?>