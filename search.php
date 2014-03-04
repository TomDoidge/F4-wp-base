<?php get_header(); ?>

<!-- Main content -->

<div class="row">
  <div class="large-8 columns">

  <!-- Articles -->

    <?php if (have_posts()) : ?>
      <div>
        <h5>Search Results for: <?php echo get_search_query(); ?></h5>
      </div>

      <hr />

      <?php while(have_posts()) : the_post(); ?><!-- find posts -->

    <?php get_template_part('content', get_post_format());?><!-- get post format and pull in content-example.php -->

    <?php endwhile; else: ?><!-- if no posts found -->

      <h1>No results were found matching your criteria. Please try something else.</h1>

    <?php endif; ?>

    <!-- Article nav -->

    <div class="large-8 columns">
      <p class="article-nav-pre"><?php next_posts_link('&larr; Older Posts'); ?></p>
      <p class="article-nav-next"><?php previous_posts_link('Newer Posts &rarr;'); ?></p>
    </div>

  </div><!-- End of Main content -->

  <!-- Sidebar -->

  <aside class="large-4 columns">

    <?php get_sidebar(); ?>

  </aside><!-- End of Sidebar -->

</div><!-- End of Main content row -->

<?php get_footer(); ?>
