<?php include('includes/init.php');
$current_page = "Edit Logo";

$image_src = NULL;

// add the image into the db
if (isset($_POST["submit_upload"])) {
  $upload_info = $_FILES["box_file"];
  // if the upload info is valid
  if ($upload_info['error'] == UPLOAD_ERR_OK) {
    $upload_name = basename($upload_info["name"]);
    $upload_ext = strtolower(pathinfo($upload_name, PATHINFO_EXTENSION) );

    // check if the file is an image
    if (in_array($upload_ext, $image_ext)) {
      $temp_file = "documents/" . "logo.png";

      if (move_uploaded_file($upload_info["tmp_name"], $temp_file)){
        array_push($messages, "Your file has been uploaded.");
        $image_src = $temp_file;
      }
      else {
        array_push($messages, "Failed to upload file.");
      }
    }
    else {
      array_push($messages, "Not an image.");
      array_push($messages, "Extension should be 'jpg', 'jpeg', 'gif' or 'png'.");
    }
  } else {
    array_push($messages, "Failed to upload file.");
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>Edit Logo</title>
</head>

<body>
<?php
if ($current_user) {
include('includes/header.php');
include('includes/sidebar.php');

?>

<div class="content">
  <form id="adminlogo" action="admin_logo.php" method="post" enctype="multipart/form-data">

  <?php
  print_messages();
  ?>
  <ul>
    <li>
      <label>Current logo:</label>
    </li>
    <li>
      <img class="logo" src="documents/logo.png" alt="current logo" >
    </li>

    <li>
      <label>Upload a logo:</label>
    </li>
    <li>
      <!-- MAX_FILE_SIZE must precede the file input field -->
      <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
      <input type="file" name="box_file" required>
    </li>
    <li>
      <button name="submit_upload" type="submit">Upload</button>
    </li>
  </ul>
</form>
</div>
<?php
include('includes/footer.php');
}
?>

</body>

</html>
