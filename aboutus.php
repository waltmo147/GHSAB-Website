<?php include('includes/init.php');
$current_page = "About Us"?>
<!DOCTYPE html>
<html>

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
<div id="about_1">
<h3> Who we are </h3>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
</div>
<div id='about_2'>
<h3>Our Members</h3>
<ul>
<?php
      $records = exec_sql_query($db, "SELECT * FROM members")->fetchAll(PDO::FETCH_ASSOC);

      foreach($records as $record){
      $image_records = exec_sql_query($db, "SELECT * FROM member_images WHERE member_id =".$record['id'])->fetchAll(PDO::FETCH_ASSOC);
        echo "<li>";
        echo "<img class='team_imgs' src=\"" . "uploads/member_images/" . $image_records[0]["id"] . "." . $image_records[0]["file_ext"] . "\">";
        echo $record['first_name'];
        echo '<p>'.$record['introduction'].'</p>';
        echo "</li>";
      }
      ?>
</ul>
</div>
<?php include('includes/footer.php')?>
</body>
</html>
