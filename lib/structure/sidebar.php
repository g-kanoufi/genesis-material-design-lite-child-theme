<?php

/**
 * Remove the sidebar
 *
 * @since 2.0.10
 */
// remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );

/**
 * Allow shortcodes in text widgets
 *
 * @since 2.0.0
 */
 add_filter( 'widget_text', 'do_shortcode' );

