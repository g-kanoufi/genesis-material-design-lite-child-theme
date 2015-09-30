<?php

/**
 * add Foundation Classes
 */
// Main layouts - Genesis attr class related
//add_filter( 'genesis_attr_body',         'gmdl_off_canvas_body_class');
add_filter( 'genesis_attr_site-container', 'gmdl_site_container_class');
add_filter( 'genesis_attr_site-header',         'gmdl_add_header_class');
add_filter( 'genesis_attr_title-area',         'gmdl_add_titlearea_class' );
add_filter( 'genesis_attr_header-widget-area',         'gmdl_add_header_widgetarea_class');
add_filter( 'genesis_attr_structural-wrap',         'gmdl_add_row_wrap_class');
add_filter( 'genesis_attr_entry-image', 'gmdl_featured_image_class' );
add_filter( 'genesis_attr_footer-widgets',         'gmdl_add_footer_widget_class');

add_filter( 'genesis_attr_content-sidebar-wrap','gmdl_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_site-inner', 'gmdl_site_inner_class');
add_filter( 'genesis_attr_content',             'gmdl_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_sidebar-primary',     'gmdl_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_sidebar-secondary',     'gmdl_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_archive-pagination',  'gmdl_pagination_markup', 10, 2 );
add_filter( 'genesis_attr_adjacent-entry-pagination', 'gmdl_post_navigation_markup', 10, 2);
add_filter( 'genesis_attr_footer-widgets',         'gmdl_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_site-footer',         'gmdl_add_markup_class', 10, 2 );
// modify genesis classes based on genesis_site_layout on material design lite
add_filter('gmdl-classes-to-add', 'gmdl_modify_classes_based_on_template', 10, 3);



add_filter( 'genesis_register_sidebar_defaults', 'gmdl_widget_add_markup_class');

// Comments - section
add_filter( 'comment_form_defaults', 'gmdl_change_comments_button_class' );


// Site Container Class
function gmdl_site_container_class($attributes){
          $attributes['class'] .= ' mdl-layout mdl-js-layout mdl-layout--fixed-header';
      return $attributes;
}

// Header Class
function gmdl_add_header_class($attributes){
    $attributes['class'] = 'mdl-layout__header is-casting-shadow';
    return $attributes;
}
// Header Title Area
function gmdl_add_titlearea_class($attributes){
    $attributes['class'] = 'title-area mdl-layout__header-row';
    return $attributes;
}
// Header Widgets Area
function gmdl_add_header_widgetarea_class($attributes){
    $attributes['class'] = 'mdl-layout--large-screen-only';
    return $attributes;
}

// Add row to wrappers
function gmdl_add_row_wrap_class($attributes){
    $attributes['class'] .= ' mdl-grid';
    return $attributes;
}

function gmdl_site_inner_class($attributes) {
  $attributes['class'] .= ' mdl-layout__content';
  return $attributes;
}

// Archive page featured image class
function gmdl_featured_image_class( $attributes ) {
    $attributes['class'] = 'th';
    return $attributes;

}

// Pagination
function gmdl_pagination_markup($attributes){
    $attributes['class'] .= ' mdl-grid mdl-typography--text-center';
    return $attributes;
}

// Single post nav
function gmdl_post_navigation_markup($attributes){
  $attributes['class'] .= ' mdl-cell mdl-cell--12-col';
  return $attributes;
}

// Footer Widget megafooter class
function gmdl_add_footer_widget_class($attributes){
    $attributes['class'] .= ' mdl-mega-footer';
    return $attributes;
}

function gmdl_add_markup_class( $attr, $context ) {
    // default classes to add
    $classes_to_add = apply_filters ('gmdl-classes-to-add',
        array(
        	'content-sidebar-wrap'       => 'mdl-grid',
        	'sidebar-content-wrap'       => 'mdl-grid',
                'content'   => 'mdl-cell mdl-shadow--4dp',
                'sidebar-primary'   => 'mdl-cell',
                'sidebar-secondary'   => 'mdl-cell',
        ),
        $context,
        $attr
    );

    // populate $classes_array based on $classes_to_add
    $value = isset( $classes_to_add[ $context ] ) ? $classes_to_add[ $context ] : array();

    if ( is_array( $value ) ) {
        $classes_array = $value;
    } else {
        $classes_array = explode( ' ', (string) $value );
    }

    // apply any filters to modify the class
    $classes_array = apply_filters( 'gmdl-add-class', $classes_array, $context, $attr );

    $classes_array = array_map( 'sanitize_html_class', $classes_array );

    // append the class(es) string (e.g. 'span9 custom-class1 custom-class2')
    $attr['class'] .= ' ' . implode( ' ', $classes_array );

    return $attr;
}

// remove unused layouts
// genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
//genesis_unregister_layout( 'sidebar-content-sidebar' );

function gmdl_layout_options_modify_classes_to_add( $classes_to_add ) {

    $layout = genesis_site_layout();



    // full-width-content       // supported
    if('full-width-content' === $layout){
        $classes_to_add['content'] .= ' mdl-cell--12-col';
    }

    // content-sidebar          // default
    if ( 'content-sidebar' === $layout ) {
	$classes_to_add['content'] .= ' mdl-cell--8-col';
	$classes_to_add['sidebar-primary'] .= ' mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid';
    }

    // sidebar-content
    if ( 'sidebar-content' === $layout ) {
	$classes_to_add['content'] .= ' mdl-cell--8-col mdl-cell--order-2-desktop';
	$classes_to_add['sidebar-primary'] .= ' mdl-cell--4-col mdl-cell--8-col-tablet mdl-cell--order-1-desktop mdl-grid';
    }

    // content-sidebar-sidebar
     if ( 'content-sidebar-sidebar' === $layout ) {
	$classes_to_add['content'] .= ' mdl-cell--6-col';
	$classes_to_add['sidebar-primary'] .= ' mdl-cell--3-col mdl-cell--8-col-tablet mdl-grid';
	$classes_to_add['sidebar-secondary'] .= ' mdl-cell--3-col mdl-cell--8-col-tablet mdl-grid';
    }

    // sidebar-sidebar-content  // not yet supported
     if ( 'sidebar-sidebar-content' === $layout ) {
	$classes_to_add['content'] .= ' mdl-cell--8-col-tablet mdl-cell--6-col mdl-cell--order-3-desktop';
	$classes_to_add['sidebar-primary'] .= ' mdl-cell--3-col mdl-cell--8-col-tablet mdl-cell--order-1-desktop mdl-grid';
	$classes_to_add['sidebar-secondary'] .= ' mdl-cell--3-col mdl-cell--8-col-tablet mdl-cell--order-2-desktop mdl-grid';

    }

    // sidebar-content-sidebar
     if ( 'sidebar-content-sidebar' === $layout ) {
	$classes_to_add['content'] .= ' mdl-cell--8-col-tablet mdl-cell--6-col mdl-cell--order-2-desktop';
	$classes_to_add['sidebar-primary'] .= ' mdl-cell--3-col mdl-cell--8-col-tablet mdl-cell--order-1-desktop mdl-grid';
	$classes_to_add['sidebar-secondary'] .= ' mdl-cell--3-col mdl-cell--8-col-tablet mdl-cell--order-3-desktop mdl-grid';
    }

    return $classes_to_add;
};

function gmdl_modify_classes_based_on_template( $classes_to_add, $context, $attr ) {
    $classes_to_add = gmdl_layout_options_modify_classes_to_add( $classes_to_add );

    return $classes_to_add;
}


function gmdl_widget_add_markup_class($params){
    $params['before_widget'] = genesis_markup( array(
            'html5' => '<section id="%1$s" class="widget mdl-cell mdl-cell--12-col mdl-cell--4-col-tablet  %2$s"><div class="widget-wrap">',
            'xhtml' => '<div id="%1$s" class="widget mdl-cell mdl-cell--12-col mdl-cell--4-col-tablet  %2$s"><div class="widget-wrap">',
            'echo'  => false,
        ) );
    return $params;
}

function gmdl_change_comments_button_class( $arg ) {
    $arg['class_submit'] = 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast';
    // return the modified array
    return $arg;
}

