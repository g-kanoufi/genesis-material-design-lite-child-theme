<?php
add_filter( 'genesis_search_text', 'gmdl_search_text' );
/**
 * Customize the search form input box text
 *
 * See: http://www.briangardner.com/code/customize-search-form/
 *
 * @since 2.0.0
 */
function gmdl_search_text() {
	return __( 'Search the website...' , 'genesis-material-design-lite-child-theme');
}

add_filter( 'genesis_search_button_text', 'gmdl_search_button_text' );
/**
 * Customize the search form input button text
 *
 * See: http://www.briangardner.com/code/customize-search-form/
 *
 * @since 2.0.0
 */
function gmdl_search_button_text( $text ) {
	return esc_attr(__('Search', 'genesis-material-design-lite-child-theme') );
}


/**
 *
 *  Add search box in a modal
 *
 */
//add_action('genesis_before_header', 'gmdl_search_modal');

function gmdl_search_modal(){
	$search_form = '<div id="search-container" class="search-box-wrapper modal">
      <div class="search-box">'.get_search_form(false).'</div></div>';
      echo $search_form;
}

//add_action( 'template_redirect', 'gmdl_redirect_single_search_result' );
/**
 * Redirect to the result itself, if only one search result is returned
 *
 * See: http://www.developerdrive.com/2013/07/5-quick-and-easy-tricks-to-improve-your-wordpress-theme/
 *
 * @since 2.0.5
 */
function gmdl_redirect_single_search_result() {

    if( is_search() ) {
        global $wp_query;

        if( $wp_query->post_count == 1) {
            wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
        }
    }

}

// add_filter( 'pre_get_posts', 'gmdl_only_search_posts' );
/**
 * Limit searching to just posts, excluding pages and CPTs
 *
 * See: http://www.mhsiung.com/2009/11/limit-wordpress-search-scope-to-blog-posts/
 *
 * @since 2.0.18
 */
function gmdl_only_search_posts( $query ) {

	if( $query->is_search ) {
		$query->set( 'post_type', 'post' );
	}
	return $query;

}
