<?php

$user_meta = get_userdata( $user_id );

$user_roles = $user_meta->roles; // array with all the roles the user is part of.

$wp_user_object = new WP_User($current_user->ID);
$wp_user_object->set_role('editor');

