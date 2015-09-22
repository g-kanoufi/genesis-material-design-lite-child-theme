<?php



add_filter("post_gallery", "gmdl_gallery_clearing",10,2);
function gmdl_gallery_clearing($output, $attr) {
    global $post;

    static $instance = 0;
    $instance++;

    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'li',
        'icontag'    => '',
        'captiontag' => '',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $gallery_style = $gallery_div = '';
    //if ( apply_filters( 'use_default_gallery_style', true ) )
    $size_class = sanitize_html_class( $size );
    // These additions of class for mdl should be in the mdl folder, but as we had to rework on the whole gallery shortcode, i though it was better to have it all here
    $gallery_div = "<ul id='$selector' class='mdl-grid mdl-grid--no-spacing small-block-grid-{$columns} gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        if( isset($attr['link']) && 'file' == $attr['link']){
           $link=  '<a href="'.wp_get_attachment_url( $id ).'">'.wp_get_attachment_image( $id, $size, false, array('class' => 'attachment-image' ) ).'</a>';
        }else{
            $link = '<a href="'.get_attachment_link( $id ).'">'.wp_get_attachment_image( $id, $size, false, array('class' => 'attachment-image' ) ).'</a>';
        }

        $output .= "<{$itemtag} class='gallery-item mdl-cell mdl-cell--3-col mdl-cell--2-col-tablet'>";
        $output .=  $link;

        /*
         * This is the caption part so i'll comment that out
         * #2 in question
         */
        /*
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='wp-caption-text gallery-caption'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
        }*/
        $output .= "</{$itemtag}>";
    }

    /**
     * this is the extra br you want to remove so we change it to jus closing div tag
     * #3 in question
     */
    /*$output .= "
            <br style='clear: both;' />
        </div>\n";
     */

    $output .= "</ul>\n";
    return $output;
}
