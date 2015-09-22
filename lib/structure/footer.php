<?php

add_filter( 'genesis_footer_creds_text', 'gmdl_footer_creds_text' );

/**
 * Custom footer 'creds' text
 *
 * Note: Avoid adding <p> tags here, since it causes an HTML validation error in Genesis
 *
 * @since 2.0.0
 */
function gmdl_footer_creds_text() {
	 return 'Copyright [footer_copyright] <a href="https://lostwebdesigns.com">'._e('Lost Webdesign</a> - Materialesis - A Genesis Child theme made with <span class="♥">♥</span> and Material Design Lite', 'genesis-material-design-lite-child-theme');

}
