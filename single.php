<?php
// Post page structure
 ?>
 <?php get_header(); ?>

<div class="row">
  <div class="large-8 columns">

  <!-- Articles -->

    <?php if (have_posts()) : while(have_posts()) : the_post(); ?><!-- find posts -->

    <article <?php post_class('row'); ?> id="post-<?php the_id(); ?>">

    <div class="large-12 columns">

      <header>
        <p><?php the_category('&nbsp;&nbsp;|&nbsp;&nbsp;'); ?></p><!-- show category -->
        <h1><?php the_title(); ?></h1><!-- show title -->

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
          <?php the_post_thumbnail('custom-blog-image'); ?>
        </figure>
      <?php else : ?><!-- if no thumbnail post this -->
        <hr />
      <?php endif; ?><!-- End of post thumbnail -->

      <!-- The content -->

      <?php the_content(''); ?><!-- Content-->

      <!-- Tags -->

      <?php if (has_tag()) : ?>
        <p class="tag-container"><?php the_tags(); ?></p>
      <?php endif; ?>

      <!-- Author section -->
      <h5>Article by <?php the_author_posts_link(); ?></h5>
      <?php the_author_meta('description'); ?>

    </div><!-- End of 12 column -->

      <?php endwhile; else : ?><!-- if no posts found-->

      <article>
        <h1>No posts were found!</h1>
      </article>

      <?php endif; ?>

    </article><!-- End of row -->

    <!-- Post navigation-->

    <div>
      <?php $args = array(
        'before' => '<p class="post-navigation">',
        'after' => '</p>',
        'pagelink' => 'Page %'
      ); ?>
      <?php wp_link_pages('$args'); ?>

    </div><!-- End of Post navigation-->

    <!-- Comments-->

    <div class="large-12 columns">
      <?php comments_template('', true); ?>
    </div><!-- End of comments-->

  </div><!-- End of Main content 8 columns-->

  <!-- Sidebar -->

  <aside class="large-4 columns">

    <?php get_sidebar(); ?>

  </aside><!-- End of Sidebar -->

</div><!-- End of Main content row -->

<?php get_footer(); ?>