<?php
include("includes/init.php");
include('includes/sidebar.php');

// declare the current location, utilized in header.php
$current_page_id="login";

// Set maximum file size for uploaded files.
// MAX_FILE_SIZE must be set to bytes
// 1 MB = 1000000 bytes
const MAX_FILE_SIZE = 1000000;
const BOX_UPLOADS_PATH = "uploads/paintings/";

if ($current_user) {
  $user_id = $current_user_id;

  if (isset($_POST["submit_upload"])) {
    $upload_info = $_FILES["box_file"];
    $upload_desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

    if ($upload_info['error'] == UPLOAD_ERR_OK) {
      $upload_name = basename($upload_info["name"]);
      $upload_ext = strtolower(pathinfo($upload_name, PATHINFO_EXTENSION) );

      $sql = "INSERT INTO paintings (file_name, file_ext, description) VALUES (:filename, :extension, :description)";
      $params = array(
        ':extension' => $upload_ext,
        ':filename' => $upload_name,
        ':description' => $upload_desc,
      );
      $result = exec_sql_query($db, $sql, $params);

      if ($result) {
        $file_id = $db->lastInsertId("id");
        if (move_uploaded_file($upload_info["tmp_name"], BOX_UPLOADS_PATH . "$file_id.$upload_ext")){
          array_push($messages, "Your painting has been uploaded.");
          $sql = "INSERT INTO painting_user (painting_id, user_id) VALUES (:painting_id, :user_id)";
          $params = array(
            ':painting_id' => $file_id,
            ':user_id' => $user_id
          );
          $result = exec_sql_query($db, $sql, $params);
        }
      } else {
        array_push($messages, "Failed to upload file.");
      }
    } else {
      array_push($messages, "Failed to upload file.");
    }
  }
}

function printLoginForm() {
  ?>
  <form class="loginform" action="login.php" method="post">
        <label>Username:</label>
        <input type="text" name="username" required/>
        <label>Password:</label>
        <input type="password" name="password" required/>
        <button name="login" type="submit">Log In</button>
  </form>
  <?php
}

function printUploadForm() {
  ?>
  <h2>Upload a Painting</h2>

    <form class="loginform" action="login.php" method="post" enctype="multipart/form-data">
      <ul>
        <li>
          <label>Upload File:</label>
          <!-- MAX_FILE_SIZE must precede the file input field -->
          <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
          <input type="file" name="box_file" required>
        </li>
        <li>
          <label>Description:</label>
        </li>
        <li>
          <textarea name="description" cols="40" rows="5"></textarea>
        </li>
        <li>
          <button name="submit_upload" type="submit">Upload</button>
        </li>
      </ul>
    </form>
  <?php
}


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Log in- <?php echo $title;?></title>
</head>

<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <h1>Log in</h1>

    <?php
    print_messages();

    if (!$current_user) {
      printLoginForm();
    } else {
      // printUploadForm();
      echo "5555555555%%%%%%%%%%%%%%%%%%%%Logged in as ".$current_user;
    }
    ?>


  </div>
  <?php include("includes/footer.php");?>
</body>

</html>
