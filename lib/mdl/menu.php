<?php

/*
 *
 * Add Drawer menu
 *
 */
add_action('init', 'gmdl_add_drawer_menu' );

function gmdl_add_drawer_menu(){
  register_nav_menu( 'drawer', __('Drawer Menu', 'genesis-material-design-lite-child-theme'));
}



/**
 * Remove the primary and secondary menus
 *
 * @since 2.0.9
 */
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_header_right', 'genesis_do_nav');

add_filter( 'wp_nav_menu_args','gmdl_main_nav_walker_and_classes');


function gmdl_main_nav_walker_and_classes( $args ){
    if( 'primary'  == $args['theme_location']  || 'secondary' == $args['theme_location']) {

        $args['menu_class'] .= ' mdl-navigation';
        if( class_exists( 'Mdl_Nav_Menu' ) )
        {
            $args['walker'] = new Mdl_Nav_Menu();
        }

    }else if('drawer' == $args['theme_location'] && class_exists( 'Mdl_Nav_Menu') ){
      $args['menu_class'] .= ' genesis-nav-menu js-superfish mdl-navigation  sf-vertical';
       $args['walker'] = new Mdl_Nav_Menu();
    }

    return $args;
};


// Add Search to Primary Nav
add_filter( 'wp_nav_menu_items', 'gmdl_genesis_mdl_search_primary_nav_menu', 10, 2 );
function gmdl_genesis_mdl_search_primary_nav_menu( $menu, stdClass $args ){
  if ( 'primary' == $args->theme_location || 'drawer' == $args->theme_location){
        if( genesis_get_option( 'nav_extras' ) )
          return $menu;
    $menu .= '<li class="menu-item menu-item__search">'.get_search_form(false).'</li>' ;
    return $menu;
  }
  else{
    return $menu;
  }
}

// Add mdl 'is-active' class for the current menu item
if ( ! function_exists( 'gmdl_active_nav_class' ) ) :
function gmdl_active_nav_class( $classes, $item ) {
  if ( 1 == $item->current || true == $item->current_item_ancestor ) {
    $classes[] = 'is-active';
  }
  return $classes;
}
add_filter( 'nav_menu_css_class', 'gmdl_active_nav_class', 10, 2 );
endif;

