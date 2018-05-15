<?php include('includes/init.php');
$current_page = "";
if(isset($_GET['member_id'])){
  $member = $_GET['member_id'];
}
?>
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
      include('includes/sidebar.php');?>

<div id="about_1">
  <?php echo "<form method='get' name='delete_form' action='delete.php'>";
          echo '<input type="hidden" value='.$member.' name="member"/>';
   ?>
  <?php
        $sql = "SELECT member,first_name, last_name, introduction, email, picpath FROM (SELECT * FROM members join picliason on id = member) JOIN member_images on member_images.id = picture WHERE member=$member;";
        $records = exec_sql_query($db, $sql)->fetchAll();
          echo "<li>";
          echo "<h1>" . $records[0]['first_name'] . " " . $records[0]['last_name'] . "</h1>";
          echo "<img class='team_imgs' src=" . $records[0]['picpath'] . ">";
          //echo '<p>'.$record['introduction'].'</p>';
          echo "</li>";
          echo "<input value ='remove' type='submit' name='delete_member'>";

          echo "</form>"

    ?>


</div>
</body>
<?php include('includes/footer.php'); ?>
</html>
