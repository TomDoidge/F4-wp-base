<?php
//Prevent the direct loading of this file
if (!empty($_SERVER['SCRIPT-FILENAME']) && basename($_SERVER['SCRIPT-FILENAME']) == 'comments.php') {
  die('you cannot access this file directly.');
}

// Check if post is password protected
if (post_password_required()) : ?>
  <p>
  This post is password protected. Enter the password to view the comments.
  <?php return; ?>
  </p>
<?php endif;

if (have_comments()) : ?>

  <a href="" title=""></a>
  <h3><?php comments_number( 'No Comments', 'One Comment', '% Comments'); ?></h3>

  <ol class="comments-list">
    <?php wp_list_comments('callback=custom_comments'); ?>
  </ol>

  <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) :?>

    <div class="comments-nav-section">
      <p><?php previous_comments_link('&larr; Older Comments'); ?></p>
      <p><?php next_comments_link('Newer Comments &rarr;'); ?></p>
    </div>

  <?php endif; ?>

<?php elseif (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
  <p>Comments are closed</p>
<?php endif;

// Display comment form
comment_form();
?>