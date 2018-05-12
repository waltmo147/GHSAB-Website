<?php include('includes/init.php');
$current_page = "";?>
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
<div class = 'blogs'>
<?php
echo "<a href='new_blog.php'>add blog</a>";
$sql = "SELECT * FROM blogs";
$params = array();
$blogs = exec_sql_query($db, $sql, $params)->fetchAll();
echo "<a href='new_blog.php' >New Blog</a>";
foreach($blogs as $blog){
  echo("<div class = 'blogpost'>
      <h1>" . $blog['title'] . "</h1>
      <p>" . $blog['blog'] . "</p>
      <h2> By " . $blog['author'] . "</h2>
      <a href='delete.php?blog_id=".$blog['id']."'>Remove</a>".
      "</div>");

}

?>
</div>
<?php include('includes/footer.php')?>
</body>
</html>
