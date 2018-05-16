<?php include('includes/init.php');
$current_page = "Edit Home Texts";?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>Edit Home Texts</title>
</head>
<?php
if($current_user == NULL){
  header('location: index.php');
}

if(isset($_POST['delete'])){
  $sql = "DELETE FROM maindescription WHERE id = :id AND title = :title;";
  $id = $_POST['id'];
  $title = $_POST['title'];
  $params = array(':id' => $id,
                  ':title' => $title);
  exec_sql_query($db, $sql, $params);
}

if(isset($_POST["edit"])){
  $showtexts = FALSE;
  }
else{
  $showtexts = TRUE;
}
if(isset($_POST["changetext"])){
  $showtexts = TRUE;
  $id = $_POST['id'];
  $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
  $body = filter_input(INPUT_POST, "body", FILTER_SANITIZE_STRING);
  $sql = "UPDATE maindescription SET (title, body)
                = (:title, :body)
                WHERE id = :id;";
  $params = array(':id' => $id,
                  ':title' => $title,
                  ':body' => $body);
  exec_sql_query($db, $sql, $params);
  }

if(isset($_POST["addtext"])){
  $showtexts = TRUE;
  $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
  $body = filter_input(INPUT_POST, "body", FILTER_SANITIZE_STRING);
  $sql = "INSERT INTO maindescription (title, body)
              VALUES (:title, :body);";
  $params = array(':title' => $title,
                  ':body' => $body);
  exec_sql_query($db, $sql, $params);
  }
?>
<body>
<?php include('includes/header.php');
include('includes/sidebar.php');
?>
<div class = "indexbody">
  <div class = "indextext">
  <?php
  if($showtexts){
    $sql = "SELECT * FROM maindescription";
    $params = array();
    $text = exec_sql_query($db,$sql,$params)->fetchAll();
    foreach($text as $bodyelement){
      $id = $bodyelement['id'];
      $title = $bodyelement['title'];
      $body = $bodyelement['body'];
      $body = explode("\n", $body);
      echo "<h1>".htmlspecialchars($title)."</h1>";
      foreach($body as $par){
        echo "<p>".htmlspecialchars($par)."</p>";
        }
      $body = implode("\n", $body);
      ?>
      <form class = "edittext" action="admin-home.php" method="post">
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"/>
      <input type="hidden" name="title" value="<?php echo htmlspecialchars($title); ?>"/>
      <input type="hidden" name="body" value="<?php echo htmlspecialchars($body); ?>"/>
      <input type="hidden" name="edit" value="edit"/>
      <button>Edit</button>
      </form>
      <form class = "deletetext" action="admin-home.php" method="post">
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"/>
      <input type="hidden" name="title" value="<?php echo htmlspecialchars($title); ?>"/>
      <input type="hidden" name="body" value="<?php echo htmlspecialchars($body); ?>"/>
      <input type="hidden" name="delete" value="delete"/>
      <button onclick="return confirm('Are you sure you want to delete this text?')" >Delete</button>
      </form>
      <?php
    }?>
    <form class = "addtext" action="admin-home.php" method="post">
      <h2>Add New Text:</h2>
      <label>Title:</label>
      <textarea class = "simple" cols = '20' rows = '2' name="title"></textarea>
      <label>Body:</label>
      <textarea class = "simple" cols = '180' rows = '30' name="body"></textarea>
      <button name="addtext" type="submit" onclick="return confirm('Add new text?')">Add New Text</button>
    </form>
    <?php
  }
  else{
    $sql = "SELECT body FROM maindescription WHERE id = :id AND title = :title;";
    $id = $_POST['id'];
    $title = $_POST['title'];
    $params = array(':id' => $id,
                    ':title' => $title);
    $text = exec_sql_query($db, $sql, $params)->fetchAll();
    $body = $text[0]['body'];
    ?>
    <form class = "edittext" action="admin-home.php" method="post">
      <label>Title:</label>
      <textarea class = "simple" cols = '20' rows = '2' name="title" name = "title"><?php echo htmlspecialchars($title); ?></textarea>
      <label>Body:</label>
      <textarea class = "simple" cols = '180' rows = '30' name="body" name = "body" ><?php echo htmlspecialchars($body); ?></textarea>
      <input type="hidden" name="id" value="<?php echo($id); ?>"/>
      <button name="changetext" type="submit" onclick="return confirm('Are you satisfied with your changes?')">Submit Changes</button>
    </form>
    <?php
  }
  ?>

</div>
</div>
<?php include('includes/footer.php'); ?>
</body>

</html>
