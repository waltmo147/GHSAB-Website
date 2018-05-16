<?php include('includes/init.php');
$current_page = "Edit About Us"?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>Edit About Us</title>
</head>

<body>
<?php
      include('includes/header.php');
      include('includes/sidebar.php');
      ?>
<div id="about_1">
<h3> Who we are </h3>
<p>The GHSAB is a diverse team of dedicated, enthusiastic, and innovative upperclassmen that represents the Global Health Program and assists with overall program development.  This development includes organizing information sessions and other means of communicating various programs, an intramural Cornell Global Health Case Competition, and organizing Global Health related workshops and various events on campus.
</p>
</div>
<div id='about_2'>
<h3>Edit Members</h3>
<a class='edit_links' href="new.php?add_member=true">Add new Member</a>
<ul>
<?php
      $sql = "SELECT member,first_name, last_name, introduction, email, picpath FROM (SELECT * FROM members join picliason on id = member) JOIN member_images on member_images.id = picture;";
      $records = exec_sql_query($db, $sql)->fetchAll();

      foreach($records as $record){
        echo "<li>";
        echo "<h1>" . $record['first_name'] . " " . $record['last_name'] . "</h1>";
        echo "<img class='team_imgs' src=" . $record['picpath'] . "alt=' '>";
        //echo "<input name='pic_name' type='hidden' value=".$record['first_name']>;
        echo "<a class='edit_links' href='delete.php?member_id=".$record['member']."'>remove_member</a>";
        //echo '<p>'.$record['introduction'].'</p>';
        echo "</li>";
      }
      ?>

</ul>

</div>
<?php include('includes/footer.php'); ?>
</body>
</html>
