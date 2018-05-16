<?php include('includes/init.php');
$current_page = "Edit Blogs";
$show_preview=FALSE;
if(isset($_POST['submit_blog'])){
  $title = filter_input(INPUT_POST, 'blog_title', FILTER_SANITIZE_STRING);
  $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
  $blog = filter_input(INPUT_POST, 'blog', FILTER_SANITIZE_STRING);
  add_blog($title,$author,$blog);
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
  <title>About Us</title>
</head>

<body>
<?php
      include('includes/header.php');
      include('includes/sidebar.php');
      ?>

<div id='about_2'>

<form method='post' name='new_blog' action='new_blog.php'>
  <fieldset>
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
      <input type='submit' name='submit_blog'>
  </ul>
</fieldset>
</form>
<?php print_messages();
  if($show_preview){
    echo"<a href='blog.php'>preview</a>";
  }
 ?>
</div>
<?php include('includes/footer.php'); ?>
</body>
</html>
