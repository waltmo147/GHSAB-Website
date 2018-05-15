<?php include('includes/init.php');
$current_page = "Admin Events";
//get all events


function print_events($events) {
  ?>
  <table>
    <tr>
      <th>     </th>
      <th>Event</th>
      <th>Time</th>
      <th>Address</th>
      <th>Description</th>
      <th>Remove</th>
    </tr>
  <?php
  foreach ($events as $event) {
    ?>
    <tr>
      <td>
      <?php
      $current_event = $event["id"];
      if ($event["image"] != NULL) {
        $image_file = "uploads/events/".$event["id"].".".$event["image"];

      } else {
        $image_file = "documents/logo.png";
      }

      //echo $image_file;
      echo "<img src=".$image_file." alt=' ' width=120 height=120> ";
      ?>
      </td>
      <td><?php echo htmlspecialchars($event["name"]);?></td>
      <td> <?php echo htmlspecialchars($event["date_time"]); ?> </td>
      <td> <?php echo htmlspecialchars($event["address"]); ?> </td>
      <td> <?php echo htmlspecialchars($event["description"]); ?> </td>
      <td>
        <form class='loginform' method="post" action="admin_event.php" enctype="multipart/form-data">
          <button type="submit" name="remove_event" value=<?php echo $current_event;?>>Remove</button>
        </form>
      </td>
    </tr>
    <?php
  }
  echo "</table>";
}

function date_check($date) {
  $split = array();
  if (preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $split)) {
    return checkdate($split[2], $split[3], $split[1]);
  }
  return false;
}

$valid_form = TRUE;

if (isset($_POST["submit_upload"])) {
  $upload_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $upload_desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
  $upload_date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
  $upload_time = trim(filter_input(INPUT_POST, 'time', FILTER_SANITIZE_STRING));
  $upload_location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);

  if ($upload_name == NULL) {
    $valid_form = FALSE;
    array_push($messages, "Name is invalid.");
  }
  else {
    $name = $upload_name;
  }

  if ($upload_desc == NULL) {
    $valid_form = FALSE;
    array_push($messages, "Description is invalid.");
  }
  else {
    $description = $upload_desc;
  }

  if ($upload_location == NULL) {
    $valid_form = FALSE;
    array_push($messages, "Location is invalid.");
  }
  else {
    $location = $upload_location;
  }

  if (date_check($upload_date)) {
    $date = $upload_date;
  }
  else {
    $valid_form = FALSE;
    array_push($messages, 'Date is invalid, date should be "yyyy-mm-dd".');
  }

  if (preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $upload_time)) {
    $time = $upload_time;
  }
  else {
    $valid_form = FALSE;
    array_push($messages, 'Time is invalid, date should be "HH:MM".');
  }

  $has_image = FALSE;


  $upload_info = $_FILES["box_file"];
  if ($upload_info['error'] == UPLOAD_ERR_OK) {
    $upload_name = basename($upload_info["name"]);
    $upload_ext = strtolower(pathinfo($upload_name, PATHINFO_EXTENSION) );


    if (in_array($upload_ext, $image_ext)) {
      $has_image = TRUE;
    }
    else {
      $valid_form = FALSE;
      array_push($messages, "Not an image.");
      array_push($messages, "Extension should be 'jpg', 'jpeg', 'gif' or 'png'.");
    }

  } else {
    #array_push($messages, "No image");
  }


  if ($valid_form) {
    if (isset($upload_ext)) {
      $date_time = $date.' '.$time.':00';
      $sql = "INSERT INTO events (name, date_time, address, description, image) VALUES (:name, :dt, :location, :des, :img)";
      $params = array(
        ':name' => trim($name),
        ':dt' => trim($date_time),
        ':location' => trim($location),
        ':des' => trim($description),
        ':img' => $upload_ext
      );
      $result = exec_sql_query($db, $sql, $params);
      if ($result) {
        $file_id = $db->lastInsertId("id");
        if (move_uploaded_file($upload_info["tmp_name"], BOX_EVENTS_PATH .$file_id.".".$upload_ext)){
          array_push($messages, "Your file has been uploaded.");
        }
      } else {
        array_push($messages, "Failed to upload file.");
      }
    }
    else {
      $date_time = $date.' '.$time.':00';
      $sql = "INSERT INTO events (name, date_time, address, description) VALUES (:name, :dt, :location, :des)";
      $params = array(
        ':name' => trim($name),
        ':dt' => trim($date_time),
        ':location' => trim($location),
        ':des' => trim($description),
      );
      $result = exec_sql_query($db, $sql, $params);
      if ($result) {
        $file_id = $db->lastInsertId("id");
        array_push($messages, "Successfully submitted.");
      } else {
        array_push($messages, "Failed to submit event.");
      }
    }
  }

}

if (isset($_POST["remove_event"])) {
  $event_id_remove = $_POST["remove_event"];
  $sql = "SELECT * from events where id is :id";
  $params = array(":id" => $event_id_remove);
  $result = exec_sql_query($db, $sql, $params)->fetchAll();
  $file = $result[0];
  $sql = "DELETE from events where id is :id";
  $params = array(":id" => $event_id_remove);
  $result = exec_sql_query($db, $sql, $params);
  if ($result) {
    $file_path = BOX_EVENTS_PATH.$file["id"].".".$file["image"];
    $result = unlink($file_path);
    if ($result) {
      //echo "Success Remove the Painting";
      $message = "Success Remove the Event";
    }
  }
}

$allevents =  exec_sql_query($db, "SELECT * FROM events", NULL)->fetchAll();

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
include('includes/sidebar.php');
if ($current_user) {
?>

<div class='event_form'>


  <form class='loginform' method="post" action="admin_event.php" enctype="multipart/form-data">
    <fieldset>
      <legend>Event form</legend>
      <?php print_messages(); ?>
      <ul>
        <li>
          <label>Name:</label>
        </li>
        <li>
          <input type="text" name="name" required/>
        </li>
        <li>
          <label>Date and Time:</label>
        </li>
        <li>
          <input type="date" value="2018-05-01" name='date' required/>
          <input type="time" name='time' required/>
        </li>
        <li>
          <label>Loacation:</label>
        </li>
        <li>
          <input type="text" name="location" required/>
        </li>
        <li>
          <label>Upload Image:</label>
        <!-- MAX_FILE_SIZE must precede the file input field -->
          <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
          <input type="file" name="box_file" >
        </li>
        <li>
          <label>Description:</label>
        </li>
        <li>
          <textarea name="description" cols="50" rows="10" required/></textarea>
        </li>
        <li>
          <button name="submit_upload" type="submit">Upload</button>
        </li>
      </ul>
    </fieldset>
  </form>
</div>

<div class='show_events'>
  <h3>Upcomming Events</h3>
  <?php
      print_events($allevents);
  ?>
</div>
<?php
}
include('includes/footer.php')?>
</body>
</html>
