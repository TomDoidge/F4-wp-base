<?php
// Template for a standard post
 ?>
<article <?php post_class('row'); ?> id="post-<?php the_id(); ?>">

  <div class="large-12 columns">

    <header>
    <p><?php the_category('&nbsp;&nbsp;|&nbsp;&nbsp;'); ?></p><!-- show category -->
    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1><!-- show title -->

    <?php
    // Display the comments links if comments are allowed and the post isn't pwd protected
    if (comments_open() && !post_password_required()) {
      comments_popup_link('0', '1', '%', 'article-meta-comments');
    };
     ?>

    <p><?php the_date(get_option('date_format')); ?> at <?php the_time(get_option('time_format')); ?></p><!-- show date and time as specified in wordpress -->
    <p>by <?php the_author_posts_link(); ?></p><!-- show author -->
    </header><!-- end of Article header -->

    <!-- Post thumbnail -->

    <?php if (has_post_thumbnail()) : ?><!-- show post thumbnail-->
      <figure class="large-12 columns nopadding"><!-- thumbnail -->
        <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail(); ?></a>
      </figure>
    <?php endif; ?><!-- End of post thumbnail -->

    <!-- Post content -->

    <?php the_content('Read more &raquo;'); ?><!-- Content and read more -->
  </div><!-- End of 12 column -->

</article><!-- End of row -->

<hr>