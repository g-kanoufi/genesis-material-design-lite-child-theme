<?php

add_filter('the_content_more_link', 'gmdl_more_tag_excerpt_link' );
/**
 * Customize the excerpt text, when using the <!--more--> tag
 *
 * See: http://my.studiopress.com/snippets/post-excerpts/
 *
 * @since 2.0.16
 */
function gmdl_more_tag_excerpt_link() {

	return ' <p><a class="more-link mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="' . get_permalink() . '">'.__("Read More", 'genesis-material-design-lite-child-theme' ).'</a></p>';

}

add_filter( 'excerpt_more', 'gmdl_truncated_excerpt_link' );
add_filter( 'get_the_content_more_link', 'gmdl_truncated_excerpt_link' );
/**
 * Customize the excerpt text, when using automatic truncation
 *
 * See: http://my.studiopress.com/snippets/post-excerpts/
 *
 * @since 2.0.16
 */
function gmdl_truncated_excerpt_link() {

	return '... <p><a class="more-link mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="' . get_permalink() . '">'.__("Read More", 'genesis-material-design-lite-child-theme' ).'</a></p>';

}


/**
 *
 * Add flex-video wrapper to oembeded items
 *
 **/

function gmdl_embed_filter( $html, $url, $attr ) {
    $yt = "/(?:https?:\\/\\/)?(?:www\\.)?(?:youtu\\.be\\/|youtube\\.com\\/(?:embed\\/|v\\/|playlist\\?|watch\\?v=|watch\\?.+(?:&|&#38;);v=))([a-zA-Z0-9\\-_]{11})?(?:(?:\\?|&|&#38;)index=((?:\\d){1,3}))?(?:(?:\\?|&|&#38;)?list=([a-zA-Z\\-_0-9]{34}))?(?:\\S+)?/";

    $vm = "/(?:https?:\/\/)?(?:www\.)?(?:vimeo\.com\/)((?:\d){1,3})?(?:\S+)?/";

    if(preg_match_all($yt, $url, $matches))
       $html = '<div class="flex-video">'. $html .'</div>';
    if(preg_match_all($vm, $url, $matches))
       $html = '<div class="flex-video vimeo">'. $html .'</div>';

    return $html;
}
add_filter('embed_oembed_html', 'gmdl_embed_filter', 90, 3 );


/**
 *
 * Add author box on single posts
 *
 **/
add_filter( 'get_the_author_genesis_author_box_single', '__return_true' );


/**
 *
 * Add Next Previous Pagination
 *
 **/
add_action( 'genesis_after_entry_content', 'gmdl_prev_next_post_nav', 5 );
function gmdl_prev_next_post_nav(){

	if ( ! is_singular( 'post' ) )
		return;
        echo '<div class="mdl-card__actions mdl-card--border mdl-grid">';
	genesis_markup( array(
		'html5'   => '<ul %s>',
		'xhtml'   => '<ul class="pagination navigation mdl-cell mdl-cell--12-col">',
		'context' => 'adjacent-entry-pagination',
	) );

	echo '<li class="arrow pagination-previous alignleft">';
	previous_post_link('%link', '<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--accent  mdl-color-text--white role=" presentation"="" data-upgraded=",MaterialButton,MaterialRipple"><i class="material-icons">keyboard_arrow_left</i><span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button> %title');
	echo '</li>';

        echo '<li class="section-spacer"></li>';

	echo '<li class="arrow pagination-next alignright">';
	next_post_link('%link', '%title <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--accent  mdl-color-text--white role=" presentation"="" data-upgraded=",MaterialButton,MaterialRipple"><i class="material-icons">keyboard_arrow_right</i><span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>');
	echo '</li>';

	echo '</ul></div>';
}

