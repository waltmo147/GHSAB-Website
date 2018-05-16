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
if(isset($_POST['edit'])){
  $showtext = FALSE;
  $id = $_POST['memberid'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $desc = $_POST['desc'];
}
elseif(isset($_POST['changetext'])){
  $showtext = TRUE;
  $id = $_POST['memberid'];
  $fname = $_POST['fname'];
  $desc = $_POST['desc'];
  $sql = "UPDATE members SET (introduction) = (:introduction) WHERE id = :id AND first_name = :first_name;";
  $params = array(':introduction' => $desc,
                  ':id' => $id,
                  ':first_name' => $fname);
  exec_sql_query($db, $sql, $params);
}
else{
  $showtext = TRUE;
}
include('includes/header.php');
include('includes/sidebar.php');?>
<div id='about_2'>
<h3>Edit Members</h3>
<ul>
<?php
      if($showtext){
      ?><a class='edit_links' href="new.php?add_member=true">Add new Member</a><?php
      $sql = "SELECT member,first_name, last_name, introduction, email, picpath FROM (SELECT * FROM members join picliason on id = member) JOIN member_images on member_images.id = picture;";
      $records = exec_sql_query($db, $sql)->fetchAll();

      foreach($records as $record){
        $picpath = $record['picpath'];
        $memberid = $record['member'];
        $fname = $record['first_name'];
        $lname = $record['last_name'];
        $desc = $record['introduction'];
        ?><li><h1><?php echo("$fname $lname"); ?></h1>
          <img class='team_imgs' src= <?php echo("$picpath");?> alt=' '>
          <form class = "edittext" action="admin-aboutus.php" method="post">
          <input type="hidden" name="memberid" value="<?php echo($memberid); ?>"/>
          <input type="hidden" name="fname" value="<?php echo($fname); ?>"/>
          <input type="hidden" name="lname" value="<?php echo($lname); ?>"/>
          <input type="hidden" name="desc" value="<?php echo($desc); ?>"/>
          <?php
          $body = explode("\n", $desc);
          foreach($body as $par){
            echo "<p>".htmlspecialchars($par)."</p>";
          }
            ?>
          <button name="edit" type="submit">Edit</button>
          </form>
        </li><?php
        }
      }
      else{
          ?><li><h1><?php echo("$fname $lname"); ?></h1>
            <form class = "edittext" action="admin-aboutus.php" method="post">
            <input type="hidden" name="memberid" value="<?php echo($id); ?>"/>
            <input type="hidden" name="fname" value="<?php echo($fname); ?>"/>
            <textarea class = "simple" cols = '100' rows = '10' name="desc" ><?php echo($desc); ?></textarea>
            <button name="changetext" type="submit" onclick="return confirm('Are you satisfied with your changes?')">Submit Changes</button>
            </form>
          </li><?php
    }
      ?>

</ul>

</div>
<?php include('includes/footer.php'); ?>
</body>
</html>
