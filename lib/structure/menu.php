<?php


// Add mini cart to menu if on a shop page

// add_action('genesis_header_right', 'gmdl_add_mini_cart');

function gmdl_add_mini_cart(){
	global $woo_options;
	global $woocommerce;
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_woocommerce()) :

		$mini_cart ='<a href="'.esc_url( $woocommerce->cart->get_cart_url() ).'" class="mini-cart"><span>'.$woocommerce->cart->cart_contents_count.'</span></a>';
		echo $mini_cart;
	endif;
}

// Handle cart in header fragment for ajax add to cart
// add_filter('add_to_cart_fragments', 'gmdl_ajax_mini_cart');
function gmdl_ajax_mini_cart( $fragments ) {
	global $woocommerce;
	global $theretailer_theme_options;
	ob_start();
	?>

      	<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() );?>" class="mini-cart"><span><?php echo $woocommerce->cart->cart_contents_count;?></span></a>

	<?php
	$fragments['.mini-cart'] = ob_get_clean();
	return $fragments;
}
