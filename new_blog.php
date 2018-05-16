<?php include('includes/init.php');
$current_page = "Edit Blogs";
$show_preview=FALSE;
if(isset($_POST['submit_blog'])){
  $title = filter_input(INPUT_POST, 'blog_title', FILTER_SANITIZE_STRING);
  $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
  $blog = filter_input(INPUT_POST, 'blog', FILTER_SANITIZE_STRING);
  $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);
  add_blog($title,$author,$blog,$link);
  record_message("New Blog Added!");
  $show_preview=TRUE;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>New Blog</title>
</head>

<body>
  <?php
  include('includes/header.php');
  include('includes/sidebar.php');
  ?>

  <div id='about_2'>

    <form method='post' name='new_blog' action='new_blog.php'>
      <fieldset class='new_inputs'>
        <legend>Add new blog</legend>
        <ul>
          <li>Title:
            <input type='text' name='blog_title' required>
          </li>
          <li>Author:
            <input type='text' name='author' required>
          </li>
          <li>
            <label>Enter blog text:</label>
          </li>
          <li>
            <textarea name='blog' cols='40' rows='5'></textarea>
          </li>
          <li>
            Optional Link:
            <input type='text' name='link'>
          </li>
          <input type='submit' name='submit_blog'>
        </ul>
      </fieldset>
    </form>
    <?php print_messages();
    if($show_preview){
      echo"<a class='edit_links' href='blog.php'>preview</a>";
    }
    ?>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
</html>
