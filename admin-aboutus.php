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
if(isset($_POST['addmember'])){
  $bfile_info = $_FILES["upic"];
  $fname = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_STRING);
  $lname = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_STRING);
  $name = $fname . " " . $lname;
  $introduction = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
  if ($bfile_info["error"]==0){
    $filename = basename($bfile_info["name"]);
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $picpath = "placeholder";
    $sql = "INSERT INTO member_images (image_name, picpath)
                          VALUES (:name, :picpath)";
    $params = array(":picpath" => $picpath,
                    ":name" => $name);
    exec_sql_query($db, $sql, $params);
    $id = $db->lastInsertId("id");
    $picpath = "uploads/pictures/" . $id . "." . $ext;
    $sql = "UPDATE member_images SET picpath = :picpath WHERE id = :id;";
    $params = array(":picpath" => $picpath,
                    ":id" => $id);
    exec_sql_query($db, $sql, $params);
    move_uploaded_file($bfile_info["tmp_name"], $picpath);
    $sql = "INSERT INTO members (first_name,last_name,introduction,email) VALUES (:first_name, :last_name, :introduction, :email);";
    $params = array(":first_name" => $fname,
                    ":last_name" => $lname,
                    ":introduction" => $introduction,
                    ":email" => $email);
    exec_sql_query($db, $sql, $params);
    $sql = "INSERT INTO picliason (member, picture)
            VALUES ((SELECT id FROM members WHERE first_name = :fname),(SELECT id FROM member_images WHERE image_name = :name));";
    $params = array(":fname" => $fname,
                    ":name" => $name);
    exec_sql_query($db, $sql, $params);
  }
}
if(isset($_POST['delete'])){
  $memberid = $_POST['memberid'];
  $picpath = $_POST['picpath'];
  $sql = "DELETE FROM members WHERE id = :id;";
  $params = array(":id" => $memberid);
  exec_sql_query($db, $sql, $params);
  $sql = "DELETE FROM member_images WHERE picpath = :picpath;";
  $params = array(":picpath" => $picpath);
  exec_sql_query($db, $sql, $params);
  $sql = "DELETE FROM picliason WHERE member = :member;";
  $params = array(":member" => $memberid);
  exec_sql_query($db, $sql, $params);
  unlink("$picpath");
}
include('includes/header.php');
include('includes/sidebar.php');?>
<div id='about_2'>
<h3>Edit Members</h3>
<ul>
<?php
      if($showtext){
      $sql = "SELECT member,first_name, last_name, introduction, email, picpath FROM (SELECT * FROM members join picliason on id = member) JOIN member_images on member_images.id = picture;";
      $records = exec_sql_query($db, $sql)->fetchAll();

      foreach($records as $record){
        $picpath = $record['picpath'];
        $memberid = $record['member'];
        $fname = $record['first_name'];
        $lname = $record['last_name'];
        $desc = $record['introduction'];
        ?><h1><?php echo("$fname $lname"); ?></h1>
          <img class='team_imgs' src= <?php echo("$picpath");?> alt=' '>
          <form class = "edittext" action="admin-aboutus.php" method="post">
          <input type="hidden" name="picpath" value="<?php echo($picpath); ?>"/>
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
          <button name="delete" type="submit" onclick="return confirm('Are you sure you want to delete this member?')">Delete Member</button>
          <button name="edit" type="submit">Edit</button>
          </form>
          <?php
        }?>
        <form class = "addmember" action="admin-aboutus.php" method="post"  enctype="multipart/form-data">
          <h2>Add New Member:</h2>
          <label>First Name:</label>
          <input type = "text" name = "fname" required>
          <label>Last Name:</label>
          <input type = "text" name= "lname" required>
          <label>Description:</label>
          <textarea class = "simple" cols = '100' rows = '10' name="description" required></textarea>
          <label>Email:</label>
          <input type = "email" name = "email" required>
          <label>Upload Picture:</label>
          <input type="file" name="upic" required>
          <button name="addmember" type="submit">Add New Member</button>
        </form>
        <?php
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
