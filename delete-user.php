<?php

// put it in functions.php, plugins don't get access to some functions due to load sequence?
// can be linked to init hook in plugins

// for multisite:
require_once ABSPATH . '/wp-admin/includes/ms.php'; 
$userid = get_current_user_id();
$deleted = wpmu_delete_user( $userid );

// for non multisite:
require_once( ABSPATH.'wp-admin/includes/user.php' );
$userid = get_current_user_id();
$deleted = wp_delete_user( $userid );

if ( $deleted ) {
    echo "User deleted successfully";
} 
