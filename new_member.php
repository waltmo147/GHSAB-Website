<?php include('includes/init.php');
$current_page = "";

if (isset($_POST["submit_upload"])) {
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];
  $email = $_POST['email'];
  $intro = $_POST['introduction'];
  $upload_info = $_FILES["box_file"];
  $upload_desc = filter_input(INPUT_POST, 'introduction', FILTER_SANITIZE_STRING);

  if ($upload_info['error'] == UPLOAD_ERR_OK) {
    //add member details
    $sql = "INSERT INTO members(first_name,last_name,introduction,email) VALUES (:f_name,:l_name,:intro,:email)";
    $params = array(
      ":f_name" => $first_name,
      ":l_name" => $last_name,
      ":intro" => $intro,
      ":email" => $email
    );
    exec_sql_query($db,$sql,$params);

    //handle image
    $upload_name = basename($upload_info["name"]);
    $upload_ext = strtolower(pathinfo($upload_name, PATHINFO_EXTENSION) );

    $sql = "INSERT INTO member_images (image_name, picpath) VALUES (:image_name, :picpath )";
    $path = "uploads/pictures/".$first_name.".".$upload_ext;
    $params = array(
      ":image_name" => $upload_name,
      ":picpath" => $path
    );
    $result1 = exec_sql_query($db, $sql, $params);
    $file_id = $db->lastInsertId("id");
    //add info to picliason
    $sql = "INSERT INTO picliason (member,picture) VALUES ((SELECT members.id FROM members WHERE members.id=:id),(SELECT member_images.id FROM member_images WHERE member_images.id=:id))";
    $params = array(
      ":id" => $file_id
    );
    exec_sql_query($db, $sql, $params);

    //finalize upload
    if ($result1) {

      if (move_uploaded_file($upload_info["tmp_name"], 'uploads/pictures/'."$first_name.$upload_ext")){
        array_push($messages, "Member added!");
      }
    } else {
      array_push($messages, "Failed to upload file");
    }
  } else {
    array_push($messages, "Failed to upload file.5");
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>Blogs</title>
</head>

<body>
<?php include('includes/header.php');
include('includes/sidebar.php');
?>
<div class='blogs'>
  <form id="uploadFile" action="new_member.php" method='post' enctype="multipart/form-data">
        <ul>
          <li>
            <label>Upload File:</label>
            <!-- MAX_FILE_SIZE must precede the file input field -->
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
            <input type="file" name="box_file" required>
          </li>

            <li>
              First Name:
              <input name="first_name" type="text" required>
            </li>
            <li>
              Last Name:
              <input name="last_name" type="text" required>
            </li>
            <li>
              Email:
              <input name="email" type="text" required>
            </li>
            <li>
              <label>Description:</label>
            </li>
            <li>
            <textarea name="introduction" cols="40" rows="5"></textarea>
          </li>

          <li>
            <button name="submit_upload" type="submit">Upload</button>
          </li>
        </ul>
      </form>
      <?php print_messages(); ?>
<div>
  <?php
?>]


</body>
<?php include('includes/footer.php'); ?>
</html>
