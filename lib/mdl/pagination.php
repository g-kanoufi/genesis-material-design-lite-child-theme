<?php

remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
add_action( 'genesis_after_endwhile', 'gmdl_post_nav' );
/**
 * Conditionally echo archive pagination in a format dependent on chosen setting.
 *
 * This is shown at the end of archives to get to another page of entries.
 *
 * @since 0.2.3
 *
 * @uses genesis_get_option()            Get theme setting value.
 * @uses genesis_prev_next_posts_nav()   Prev and Next links.
 * @uses genesis_numeric_posts_nav()     Numbered links.
 */
function gmdl_post_nav() {

	if ( 'numeric' === genesis_get_option( 'posts_nav' ) )
		gmdl_numeric_posts_nav();
	else
		genesis_prev_next_posts_nav();

}

/**
 * Echo archive pagination in page numbers format.
 *
 * Applies the `genesis_prev_link_text` and `genesis_next_link_text` filters.
 *
 * The links, if needed, are ordered as:
 *
 *  * previous page arrow,
 *  * first page,
 *  * up to two pages before current page,
 *  * current page,
 *  * up to two pages after the current page,
 *  * last page,
 *  * next page arrow.
 *
 * @since 0.2.3
 *
 * @global WP_Query $wp_query Query object.
 *
 * @return null Return early if on a single post or page, or only one page present.
 */
function gmdl_numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	//* Stop execution if there's only 1 page
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	//* Add current page to the array
	if ( $paged >= 1 )
		$links[] = $paged;

	//* Add the pages around the current page to the array
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	genesis_markup( array(
		'html5'   => '<div %s>',
		'xhtml'   => '<div class="navigation">',
		'context' => 'archive-pagination',
	) );

	echo '<ul class="mdl-cell mdl-cell--12-col pagination">';

	//* Previous Post Link
	if ( get_previous_posts_link() )
		printf( '<li class="pagination-previous alignleft">%s</li>' . "\n", get_previous_posts_link( apply_filters( 'genesis_prev_link_text', '<span class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--accent mdl-color-text--white" role="presentation" data-upgraded=",MaterialButton,MaterialRipple"><i class="material-icons">arrow_back</i><span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></span>' . __( 'Previous Page', 'genesis' ) ) ) ); //* Link to first page, plus ellipses if necessary
	if ( ! in_array( 1, $links ) ) {

		$class = 1 == $paged ? ' class="current"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li class="pagination-omission">&#x02026;</li>';

	}

	//* Link to current page, plus 2 pages in either direction if necessary
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="current"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	//* Link to last page, plus ellipses if necessary
	if ( ! in_array( $max, $links ) ) {

		if ( ! in_array( $max - 1, $links ) )
			echo '<li class="pagination-omission">&#x02026;</li>' . "\n";

		$class = $paged == $max ? ' class="current"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );

	}

	//* Next Post Link
	if ( get_next_posts_link() )
		printf( '<li class="pagination-next alignright">%s</li>' . "\n", get_next_posts_link( apply_filters( 'genesis_next_link_text', __( 'Next Page', 'genesis' ) . '<span class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--accent  mdl-color-text--white" role="presentation" data-upgraded=",MaterialButton,MaterialRipple"><i class="material-icons">arrow_forward</i><span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></span>' ) ) );
	echo '</ul></div>' . "\n";

}
