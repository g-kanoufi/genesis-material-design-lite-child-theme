<?php


remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
add_action('genesis_entry_footer', 'genesis_post_info');
add_action('genesis_entry_footer', 'genesis_post_meta');

add_filter('genesis_attr_entry-footer', 'gmdl_mdl_post_footer_class');


add_filter('genesis_attr_entry-header', 'gmdl_mdl_post_header_class');


function gmdl_mdl_post_header_class($args){
  if(is_home() || is_single() || is_archive()){
    remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
    $args['class'] .= ' mdl-card__title';

    if(has_post_thumbnail()){
      $bg_id = get_post_thumbnail_id();
      $bg_url = wp_get_attachment_image_src($bg_id, 'large');

      $args['style'] = "background:url(".$bg_url[0]."); background-size:cover";
    }
  }
  return $args;
}


add_filter('genesis_attr_entry-title', 'gmdl_mdl_post_title_class');


function gmdl_mdl_post_title_class($args){
  if(is_home() || is_single() ||  is_archive()){
    $args['class'] .= ' mdl-card__title-text';
  }
  return $args;
}
add_filter('genesis_attr_entry-content', 'gmdl_mdl_post_content_class');


function gmdl_mdl_post_content_class($args){
  if(is_home() || is_single() || is_archive()){
    $args['class'] .= ' mdl-card__supporting-text';
  }
  return $args;
}

function gmdl_mdl_post_footer_class($args){
  if(is_home() || is_single() || is_archive() )
    $args['class'] .= ' mdl-card__actions mdl-card--border';
  return $args;
}



add_filter( 'comment_form_defaults', 'gmdl_mdl_comment_form' );

function gmdl_mdl_comment_form($args){
  $commenter = wp_get_current_commenter();
  $req = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );

  $args['fields']['author'] = '<p class="comment-form-author mdl-textfield mdl-js-textfield mdl-textfield--floating-label"><input id="author" class="mdl-textfield__input" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /><label class="mdl-textfield__label" for="author">' . __( 'Name', 'genesis-material-design-lite-child-theme' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> </p>';

  $args['fields']['email'] = '<p class="comment-form-email mdl-textfield mdl-js-textfield mdl-textfield--floatinglabel"><input id="email" class="mdl-textfield__input" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /><label class="mdl-textfield__label" for="email">' . __( 'Email', 'genesis-material-design-lite-child-theme' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</p>';

  $args['fields']['url'] = '<p class="comment-form-url mdl-textfield mdl-js-textdield mdl-textfield--floating-label"><input id="url" class="mdl-textfield__input" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /><label class="mdl-textfield__label" for="url">' . __( 'Website', 'genesis-material-design-lite-child-theme' ) . '</label>' . '</p>';

  $args['comment_field'] = '<p class="comment-form-comment mdl-textfield mdl-js-textfield"><textarea id="comment" class="mdl-textfield__input" name="comment" cols="45" rows="8" aria-required="true"></textarea><label class="mdl-textfield__label" for="comment">' . _x( 'Comment', 'genesis-material-design-lite-child-theme' ) . '</label></p>';
  return $args;
}
