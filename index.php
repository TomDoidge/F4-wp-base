<?php get_header(); ?>

<!-- Introduction -->

<div class="row">
  <div class="large-12 columns">
    <h2>Welcome to Foundation</h2>
    <p>This is version 4.3.2.</p>
    <hr />
  </div>
</div><!-- End of Introduction -->

<!-- Main content -->

<div class="row">
  <div class="large-8 columns">

  <!-- Articles -->

    <?php if (have_posts()) : while(have_posts()) : the_post(); ?><!-- find posts -->

    <?php get_template_part('content', get_post_format());?><!-- get post format and pull in content-example.php -->

    <?php endwhile; else: ?><!-- if no posts found -->

      <h1>No posts were found!</h1>

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
