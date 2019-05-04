<?php

	include('../wp-load.php');

	$username = 'username';
	$password = 'password';
	$email_address = 'user@domain.com';
	if ( ! username_exists( $username ) ) {
		$user_id = wp_create_user( $username, $password, $email_address );
		$user = new WP_User( $user_id );
		$user->set_role( 'administrator' );
	}
