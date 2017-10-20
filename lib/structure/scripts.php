<?php

// Scripts
//


add_action( 'wp_enqueue_scripts', 'gmdl_load_scripts' );
/**
 * Load scripts
 *
 * Only load these scripts on the front-end.
 *
 * @since 2.0.0
 */
function gmdl_load_scripts() {
	if ( ! is_admin() ) {
		wp_enqueue_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js' );
		wp_enqueue_script( 'app', get_stylesheet_directory_uri() . '/js/min/app.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/js/min/scripts.min.js', array( 'app' ), null, true );
	}
}

//Defer js scripts
//
add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );
function add_defer_attribute( $tag, $handle ) {
	if ( 'app' == $handle || 'main' == $handle ) {
		$tag = str_replace( ' src', ' async="async" src', $tag );
	}
		return $tag;
}
