<?php include('includes/init.php');
$current_page = "Edit Blogs";?>
<!DOCTYPE html>
<html lang="en">

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
$sql = "SELECT * FROM blogs";
$params = array();
$blogs = exec_sql_query($db, $sql, $params)->fetchAll();
//echo "<a href='new_blog.php' >New Blog</a>";
foreach($blogs as $blog){
  echo("<div class = 'blogpost'>
      <h1>" . htmlspecialchars($blog['title']) . "</h1>
      <p>" . htmlspecialchars($blog['blog']) . "</p>
      <h2> By " . htmlspecialchars($blog['author']) . "</h2>
      <a class='edit_links' href='delete.php?blog_id=".htmlspecialchars($blog['id'])."'>Remove</a>".
      "</div>");

}
echo "<a href='new_blog.php' class='edit_links'>add blog</a>";
?>
</div>
<?php include('includes/footer.php')?>
</body>
</html>
