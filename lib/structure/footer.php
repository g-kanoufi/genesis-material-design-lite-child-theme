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
	 return 'Copyright [footer_copyright] <a href="https://lostwebdesigns.com">Lost Webdesigns</a> - Materialesis - '. __('A Genesis Child theme made with <span class="♥">♥</span> and Material Design Lite', 'genesis-material-design-lite-child-theme');

}


add_action('genesis_after', 'gmdl_github_fixed_button');

function gmdl_github_fixed_button(){
  
    echo '<a href="https://github.com/g-kanoufi/genesis-material-design-lite-child-theme" target="_blank" id="github-fork" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast">Download/Fork on Github</a>';
}
