<?php include('includes/init.php');
$current_page = "Blog";?>
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
    foreach($blogs as $blog){
      echo("<div class='blogpost'>
      <h1 class='blog_title'>" . $blog['title']."</h1>" .
      htmlspecialchars($blog['blog']));
      if($blog['link']!=""){
        echo "<a href='".htmlspecialchars($blog['link'])."'>READ MORE</a>";
      }
      echo"<h2> By " . htmlspecialchars($blog['author']) . "</h2>
      </div>";
    }

    ?>
  </div>
  <?php include('includes/footer.php')?>
</body>
</html>
