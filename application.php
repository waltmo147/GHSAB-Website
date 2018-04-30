<?php include('includes/init.php');
$current_page = "Events";
$current_event_id = filter_input(INPUT_GET, "event_id", FILTER_VALIDATE_INT);
//get all events
$current_event =  exec_sql_query($db, "SELECT * FROM events where id is :event_id", NULL)->fetchAll();


if (isset($_POST["submit"])) {
  //validate input
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
  //get tag_id
  $sql = "SELECT * from applications where event_id is :event_id and email is :email";
  $params = array(
    ":event_id" => $current_event_id,
    ":email" => $email
  );
  $result = exec_sql_query($db, $sql, $params)->fetchAll();
  if ($result) {
    $tag = $result[0];
    $new_tag_id = $tag["id"];
  } else {
    $sql = "INSERT INTO tags (name) VALUES (:new_tag)";
    $params = array(':new_tag' => $new_tag);
    $result = exec_sql_query($db, $sql, $params);
    if ($result) {
      $new_tag_id = $db->lastInsertId("id");
    }
  }
  // add painting tag
  $sql = "INSERT INTO painting_tag (painting_id, tag_id)
  VALUES (:painting_id, :new_tag_id)";
  $params = array(
    ":painting_id" => $current_painting,
    ":new_tag_id" => $new_tag_id
  );
  $result = exec_sql_query($db, $sql, $params)->fetchAll();
  if ($result) {
    echo "New tag has been added.";
  } else {
    echo "Failed to add new tag.";
  }
}


function print_events($events) {
  ?>
  <table>
    <tr>
      <th>     </th>
      <th>Event</th>
      <th>Time</th>
      <th>Address</th>
      <th>Description</th>
    </tr>
  <?php
  foreach ($events as $event) {
    ?>
    <tr>
      <td>
      <?php
      if ($event["image"] != NULL) {
        $image_file = "uploads/events/".$event["image"];

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
    </tr>
    <?php
  }
  echo "</table>";
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
include('includes/sidebar.php');
?>
<div class='show_events'>
  <h3>Upcomming Events</h3>
  <?php
      print_events($current_event);
  ?>
</div>
<?php include('includes/footer.php')?>
</body>
</html>
