<?php include('includes/init.php');
$current_page = "";
$task;
if(isset($_GET['member_id'])){
  $task="remove_member";
  $current_member = $_GET['member_id'];
  remove_member($current_member);
  record_message("removed member!");
}elseif(isset($_GET['blog_id'])){
  $task="remove_blog";
  $blog_id = $_GET['blog_id'];
  remove_blog($blog_id);
  record_message("Blog removed");

}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>Blogs</title>
</head>

<body>
<?php include('includes/header.php');
include('includes/sidebar.php');
?>
<div class='blogs'>
<?php
print_messages();
if($task=="remove_member"){
  echo("<a class='edit_links' href='aboutus.php'>preview</a>");
}elseif($task=="remove_blog"){
  echo("<a class='edit_links' href='blog.php'>preview</a>");
}
?>
<div>


</body>
<?php include('includes/footer.php'); ?>
</html>
