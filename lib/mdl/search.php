<?php

// Remove the genesis default form
remove_filter( 'get_search_form', 'genesis_search_form');

// Replace with same function with added markup for Mdl
add_filter( 'get_search_form', 'gmdl_mdl_search_form' );

function gmdl_mdl_search_form() {
	$search_text = get_search_query() ? apply_filters( 'the_search_query', get_search_query() ) : apply_filters( 'genesis_search_text', __( 'Search this website', 'genesis-material-design-lite-child-theme' ) . ' &#x02026;' );

	$button_text = apply_filters( 'genesis_search_button_text', esc_attr__( 'Search', 'genesis-material-design-lite-child-theme' ) );

	$onfocus = "if ('" . esc_js( $search_text ) . "' === this.value) {this.value = '';}";
	$onblur  = "if ('' === this.value) {this.value = '" . esc_js( $search_text ) . "';}";

	//* Empty label, by default. Filterable.
	$label = apply_filters( 'genesis_search_form_label', '' );

	$value_or_placeholder = ( get_search_query() == '' ) ? 'placeholder' : 'value';

	if ( genesis_html5() ) {

		$form  = sprintf( '<form %s>', genesis_attr( 'search-form' ) );

			if ( '' == $label )  {
				$label = apply_filters( 'genesis_search_text', __( 'Search this website', 'genesis-material-design-lite-child-theme' ) );
			}

			$form_id = uniqid( 'searchform-' );

			$form .= sprintf(
                          '<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable"><meta itemprop="target" content="%s"/><label class="search-form-label mdl-button mdl-js-button mdl-button--icon" for="%s"><i class="material-icons">search</i></label><div class="mdl-textfield__expandable-holder"><input itemprop="query-input" type="search" name="s" class="mdl-textfield__input" id="%s" %s="%s" /></div></div></form>',
				home_url( '/?s={s}' ),
				esc_attr( $form_id ),
				esc_attr( $form_id ),
				$value_or_placeholder,
				esc_attr( $search_text )
			);


	} else {

		$form = sprintf(
'<form method="get" class="searchform search-form" action="%s" role="search" ><div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable"><label class="search-form-label mdl-button mdl-js-button mdl-button--icon" for="%s"><i class="material-icons">search</i></label><div class="mdl-textfield__expandable-holder"><input class="mdl-textfield__input s search-input" type="text" name="s" "id="%s" value="%s" onfocus="%s" onblur="%s /></div></div></form>',
			home_url( '/' ),
                        esc_attr( $form_id ),
                        esc_attr( $form_id ),
			esc_attr( $search_text ),
			esc_attr( $onfocus ),
			esc_attr( $onblur )
		);

	}

	return apply_filters( 'genesis_search_form', $form, $search_text, $button_text, $label );

}

