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
<?php
if(isset($_POST['deleteblog'])){
  $id = $_POST['id'];
  $sql = "DELETE FROM blogs WHERE id = :id;";
  $params = array(":id" => $id);
  exec_sql_query($db, $sql, $params);
}
include('includes/header.php');
include('includes/sidebar.php');

?>
<div class = 'blogs'>
<?php
$sql = "SELECT * FROM blogs";
$params = array();
$blogs = exec_sql_query($db, $sql, $params)->fetchAll();
foreach($blogs as $blog){
  echo("<div class = 'blogpost'>
      <h1>" . htmlspecialchars($blog['title']) . "</h1>
      <p>" . htmlspecialchars($blog['blog']) . "</p>
      <h2> By " . htmlspecialchars($blog['author']) . "</h2></div>");
      $id = $blog['id'];
      ?>
      <form class = "deleteblog" action="admin-blogs.php" method="post">
        <input type="hidden" name="id" value="<?php echo($id); ?>"/>
        <button name="deleteblog" type="submit" onclick="return confirm('Are you sure you want to delete this blog?')">Delete Blog</button>
      </form>
      <?php
}
echo "<a href='new_blog.php' class='edit_links'>Add Blog</a>";
?>
</div>
<?php include('includes/footer.php')?>
</body>
</html>
