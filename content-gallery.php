<?php
// Template for a gallery post - doesn't work with all galleries yet
 ?>
<article <?php post_class('row'); ?> id="post-<?php the_id(); ?>">

  <div class="large-12 columns">

    <header>
    <p><?php the_category('&nbsp;&nbsp;|&nbsp;&nbsp;'); ?></p><!-- show category -->
    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1><!-- show title -->
    <p><?php the_date(get_option('date_format')); ?> at <?php the_time(get_option('time_format')); ?></p><!-- show date and time as specified in wordpress -->
    <p>by <?php the_author_posts_link(); ?></p><!-- show author -->
    </header><!-- end of Article header -->

    <?php
      $gallery_atts = array(
        'post_parent' => $post->ID,
        'post_mime_type' => 'image'
        );
      $gallery_images = get_children($gallery_atts);

      if(!empty($gallery_images)) {
        $gallery_count = count($gallery_images);
        $first_image = array_shift($gallery_images);
        $display_first_image = wp_get_attachment_image($first_image->ID);

      ?>
      <figure class="large-12 columns"><!-- thumbnail -->
        <a href="<?php the_permalink(); ?>" ><?php echo $display_first_image; ?></a>
      </figure>

      <p><?php printf('This gallery contains %s photos.', $gallery_count);?></p>
     <?php }

    ?>
  </div><!-- End of 12 column -->

</article><!-- End of row -->

<hr>