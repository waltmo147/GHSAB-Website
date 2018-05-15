<?php include('includes/init.php');
$current_page = "Edit Slides";?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>Home</title>
</head>
<?php
if(isset($_POST['deletepic'])){
  $sql = "DELETE FROM slideshow WHERE id = :id AND title = :title;";
  $id = $_POST['picid'];
  $title = $_POST['pictitle'];
  $params = array(':id' => $id,
                  ':title' => $title);
  exec_sql_query($db, $sql, $params);
  $picpath = $_POST['picpath'];
  unlink("$picpath");
}

if(isset($_POST["upload"])){
  $bfile_info = $_FILES["upic"];
  $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
  if ($bfile_info["error"]==0){
    $filename = basename($bfile_info["name"]);
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $picpath = "placeholder";
    $sql = "INSERT INTO slideshow (picpath, title)
                          VALUES (:picpath, :title)";
    $params = array(":picpath" => $picpath,
                    ":title" => $title);
    exec_sql_query($db, $sql, $params);
    $id = $db->lastInsertId("id");
    $picpath = "uploads/pictures/" . $id . "." . $ext;
    $sql = "UPDATE slideshow SET picpath = :picpath WHERE id = :id;";
    $params = array(":picpath" => $picpath,
                    ":id" => $id);
    exec_sql_query($db, $sql, $params);
    move_uploaded_file($bfile_info["tmp_name"], $picpath);
  }
}
?>
<body>
<?php include('includes/header.php');
include('includes/sidebar.php');
?>
<div class = "slideshow-container">
<?php
$sql = "SELECT * FROM slideshow";
$params = array();
$pictures = exec_sql_query($db,$sql,$params)->fetchAll();
foreach($pictures as $picture){
  $path = $picture['picpath'];
  $title = $picture['title'];
  $id = $picture['id'];
  echo('<div class = "block">');
  echo("<h4>$title</h4>");
  echo("<img src='$path' alt='$title'>");
  ?>
  <form class = "deleteslide" action="admin-slides.php" method="post">
  <input type="hidden" name="picid" value="<?php echo($id); ?>"/>
  <input type="hidden" name="pictitle" value="<?php echo($title); ?>"/>
  <input type="hidden" name="picpath" value="<?php echo($path); ?>"/>
  <input type="hidden" name="deletepic" value="deletepic"/>
  <button onclick="return confirm('Are you sure you want to delete this picture?')" >Delete</button>
  </form>
  </div>
<?php
}
?>
<div class = "block">
<form id="addslide" action="admin-slides.php" method="post" enctype="multipart/form-data">
  <ul>
    <li>
      <label>Title:</label>
      <input type="text" name="title" required>
    </li>
    <li>
      <label>Upload file size limit: 2Mb</label>
    </li>
    <li>
      <label>Upload Picture:</label>
      <input type="file" name="upic" required>
    </li>
    <li>
      <button name="upload" type="submit">Upload</button>
    </li>
  </ul>
</form>
</div>
</div>
</body>
<?php include('includes/footer.php'); ?>
</html>
