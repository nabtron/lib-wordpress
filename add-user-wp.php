    $user_name = 'username';
    $user_email = 'email@domain.com';
    
    $user_id = username_exists( $user_name );
     
    if ( ! $user_id && false == email_exists( $user_email ) ) {
        $random_password = wp_generate_password( $length = 12, $include_standard_special_chars = false );
        $user_id = wp_create_user( $user_name, $random_password, $user_email );
    } else {
        $random_password = __( 'User already exists.  Password inherited.', 'textdomain' );
    }

    echo $random_password;
