<?php include('includes/init.php');
$current_page = "About Us"?>
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
<h3>Our Members</h3>
<ul>
<?php
      $sql = "SELECT first_name, last_name, introduction, email, picpath FROM (SELECT * FROM members join picliason on id = member) JOIN member_images on member_images.id = picture;";
      $records = exec_sql_query($db, $sql)->fetchAll();

      foreach($records as $record){
        echo "<li>";
        echo "<h1>" . $record['first_name'] . " " . $record['last_name'] . "</h1>";
        echo "<img class='team_imgs' src=" . $record['picpath'] . " alt=' '>";
        echo '<p class="intros">'.$record['introduction'].'</p>';
        echo '<strong>'.$record['email'].'</strong>';
        echo "</li>";
      }
      ?>
</ul>
</div>
<?php include('includes/footer.php'); ?>
</body>
</html>
