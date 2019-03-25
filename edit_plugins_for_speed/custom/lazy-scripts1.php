<?php defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

add_filter('script_loader_tag', 'nabcfrs_truefalse', 10, 2);

function nabcfrs_truefalse($tag) {
        global $wpdb;
        // get list of files
        $lazy_scripts = ['92a86.js','991e9.js'];
        
        foreach($lazy_scripts as $lazy_script){
            if(true == strpos($tag, $lazy_script ) ) {
                return str_replace( ' src', ' data-nabtronjs="true" src', $tag );
            }
        }
	    return $tag;
    }
}

/*
add_filter( 'script_loader_tag', 'add_id_to_script', 10, 3 );
 
function add_id_to_script( $tag, $handle, $src ) {
    if ( 'dropbox.js' === $handle ) {
        $tag = '<script type="text/javascript" src="' . esc_url( $src ) . '" id="dropboxjs" data-app-key="MY_APP_KEY"></script>';
    }
 
    return $tag;
}
*/
