<?php

remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'wp_enqueue_scripts', 'gmdl_load_stylesheets' );
/**
 * Overrides the default Genesis stylesheet with child theme specific.
 *
 * Only load these styles on the front-end.
 *
 * @since 2.0.0
 */
function gmdl_load_stylesheets() {

	if ( ! is_admin() ) {
		// Main theme stylesheet
	      wp_enqueue_style( 'app', get_stylesheet_directory_uri() . '/app.min.css', array(), null );
	      wp_enqueue_style( 'gmdl', get_stylesheet_directory_uri() . '/style.css', array( 'app' ), null );
				// Add google mdl font and icon font from google fonts
	      wp_enqueue_style( 'gmdl-font', '//fonts.googleapis.com/css?family=Roboto:300,400,500,700', array( 'gmdl' ), null );
	      wp_enqueue_style( 'gmdl-icon-font', '//fonts.googleapis.com/icon?family=Material+Icons', array( 'gmdl' ), null );

	}
}
