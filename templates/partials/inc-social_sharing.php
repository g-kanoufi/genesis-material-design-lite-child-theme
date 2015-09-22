<?php
/**
 * The template used for displaying social sharing buttons
 *
 * @package mattbanks
 * @since mattbanks 2.3
 */
?>

<!-- Social Network Sharing Buttons -->
<?php $post_url = urlencode( get_permalink($post->ID));
        $post_title = urlencode( $post->post_title);
?>
<div class="sharing">
    <ul class="share-buttons inline-list">
        <li><h6><?php _e('Share:', 'genesis-material-design-lite-child-theme');?> </h6></li>
        <li><a class="facebook modal-trigger" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_url;?>&amp;t=<?php echo $post_title;?>" target="_blank" title="<?php _e('Share on Facebook', 'genesis-material-design-lite-child-theme');?>" target="_blank"><i class="fi-social-facebook"></i></a></li>

        <li><a class="twitter modal-trigger" href="https://twitter.com/intent/tweet?source=<?php echo $post_url;?>&amp;text=<?php echo $post_title;?>:%20<?php echo $post_url;?>" target="_blank" title="<?php _e('Tweeter this', 'genesis-material-design-lite-child-theme');?>" target="_blank"><i class="fi-social-twitter"></i></a></li>

        <li><a class="email modal-trigger" href="mailto:?subject=&amp;body=<?php echo $post_title.':%20'.$post_url;?>" target="_blank" title="<?php _e('Send by Email', 'genesis-material-design-lite-child-theme');?>" onclick="window.open('mailto:?subject=<?php echo $post_title;?>) + '&amp;body=<?php echo $post_title.':%20'.$post_url;?> return false;"><i class="fi-mail"></i></a></li>
    </ul>
</div>

