<?php
// Template for a quote post
 ?>
<article <?php post_class('row'); ?> id="post-<?php the_id(); ?>">

  <div class="large-12 columns">

    <header>
    <p><?php the_category('&nbsp;&nbsp;|&nbsp;&nbsp;'); ?></p><!-- show category -->
    <p><?php the_date(get_option('date_format')); ?> at <?php the_time(get_option('time_format')); ?></p><!-- show date and time as specified in wordpress -->
    <p>by <?php the_author_posts_link(); ?></p><!-- show author -->
    </header><!-- end of Article header -->

    <div class="panel">
      <?php the_content(); ?><!-- Content-->
    </div>
  </div><!-- End of 12 column -->

</article><!-- End of row -->

<hr>