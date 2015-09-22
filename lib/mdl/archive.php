<?php


/**
 *
 * Add Mdl Cards class to posts on archive page
 *
 **/

add_filter('post_class', 'gmdl_mdl_post_class');

function gmdl_mdl_post_class($classes){

  if(is_archive() || is_home())
    $classes[] = 'mdl-card mdl-shadow--2dp';

  return $classes;
}


