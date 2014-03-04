<footer>
  <div class="row">
    <div class="large-12 columns">
      <h2>This is the footer</h2>
      <p>footer to go here</p>
      <hr />
    </div>
  </div>

  <div class="row">
    <?php get_sidebar('footer-widget-one'); ?>
    <?php get_sidebar('footer-widget-two'); ?>
    <?php get_sidebar('footer-widget-three'); ?>
  </div> <!-- end of widget row -->

  <div class="row">
    <div class="large-12 columns">
      <p>&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>.</p>
      <hr />
    </div>
  </div> <!-- end of copyright row -->

</footer>
<?php wp_footer(); ?>

  <script>
    $(document).foundation();
  </script>



</body>
</html>