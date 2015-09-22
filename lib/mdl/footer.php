<?php

remove_action('genesis_before_footer', 'genesis_footer_widget_areas');
add_action( 'genesis_before_footer', 'gmdl_footer_widget_areas' );
/**
 * Echo the markup necessary to facilitate the footer widget areas.
 *
 * Check for a numerical parameter given when adding theme support - if none is found, then the function returns early.
 *
 * The child theme must style the widget areas.
 *
 * Applies the `genesis_footer_widget_areas` filter.
 *
 * @since 1.6.0
 *
 * @uses genesis_structural_wrap() Optionally adds wrap with footer-widgets context.
 *
 * @return null Return early if number of widget areas could not be determined, or nothing is added to the first widget area.
 */
function gmdl_footer_widget_areas() {

	$footer_widgets = get_theme_support( 'genesis-footer-widgets' );

	if ( ! $footer_widgets || ! isset( $footer_widgets[0] ) || ! is_numeric( $footer_widgets[0] ) )
		return;

	$footer_widgets = (int) $footer_widgets[0];

        $footer_widget_large_class = 12/$footer_widgets;
	//* Check to see if first widget area has widgets. If not, do nothing. No need to check all footer widget areas.
	if ( ! is_active_sidebar( 'footer-1' ) )
		return;

	$inside  = '';
	$output  = '';
 	$counter = 1;

	while ( $counter <= $footer_widgets ) {

		//* Darn you, WordPress! Gotta output buffer.
		ob_start();
		dynamic_sidebar( 'footer-' . $counter );
		$widgets = ob_get_clean();

		$inside .= sprintf( '<div class="mdl-cell mdl-cell--4-col-tablet mdl-cell-%d-col footer-widgets-%d widget-area">%s</div>', $footer_widget_large_class,  $counter, $widgets );

		$counter++;

	}

	if ( $inside ) {

		$output .= genesis_markup( array(
			'html5'   => '<div %s>',
			'xhtml'   => '<div id="footer-widgets" class="footer-widgets mdl-mega-footer">',
			'context' => 'footer-widgets',
		) );

		$output .= genesis_structural_wrap( 'footer-widgets', 'open', 0 );

		$output .= $inside;

		$output .= genesis_structural_wrap( 'footer-widgets', 'close', 0 );

		$output .= '</div>';

	}

	echo apply_filters( 'genesis_footer_widget_areas', $output, $footer_widgets );

}

