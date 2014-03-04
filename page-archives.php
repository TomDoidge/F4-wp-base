<?php
/*
  Template Name: Archives Page
*/
 ?>

 <?php get_header(); ?>

<div class="row">
  <div class="large-8 columns">

    <div class="large-12 columns">

      <header>
        <h1><?php the_title(); ?></h1><!-- show title -->

        <!-- WP edit title option -->

        <?php if (current_user_can('edit_post', $post->ID)) {
          edit_post_link('Edit this','<p class="article-meta-extra">', '</p>');
          } ?>

      </header><!-- end of Article header -->

      <h4>Archives by Month</h4>
      <ul>
        <?php wp_get_archives('type=monthly'); ?>
      </ul>

      <hr />

      <h4>Archives by Subject</h4>
      <ul>
        <?php wp_list_categories('title_li='); ?>
      </ul>

    </div><!-- End of 12 column -->

  </div><!-- End of Main content 8 columns-->

  <!-- Sidebar -->

  <aside class="large-4 columns">

    <?php get_sidebar(); ?>

  </aside><!-- End of Sidebar -->

</div><!-- End of Main content row -->

<?php get_footer(); ?>