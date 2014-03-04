<?php
/*
  Template Name: Full Width Page
*/
 ?>

 <?php get_header(); ?>

<div class="row">
  <div class="large-12 columns">

  <!-- Articles -->

    <?php if (have_posts()) : while(have_posts()) : the_post(); ?><!-- find posts -->

    <div class="large-12 columns">

      <header>
        <h1><?php the_title(); ?></h1><!-- show title -->

        <!-- WP edit title option -->

        <?php if (current_user_can('edit_post', $post->ID)) {
          edit_post_link('Edit this','<p class="article-meta-extra">', '</p>');
          } ?>

      </header><!-- end of Article header -->

      <!-- The content -->

      <?php the_content(''); ?><!-- Content-->

    </div><!-- End of 12 column -->

      <?php endwhile; else : ?><!-- if no posts found-->

      <article>
        <h1>No posts were found!</h1>
      </article>

      <?php endif; ?>

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

  </div><!-- End of Main content 12 columns-->

</div><!-- End of Main content row -->

<?php get_footer(); ?>