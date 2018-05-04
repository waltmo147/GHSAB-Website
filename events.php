<?php include('includes/init.php');
$current_page = "Events";
//get all events
$allevents =  exec_sql_query($db, "SELECT * FROM events", NULL)->fetchAll();

function print_events($events) {
  ?>
  <table>
    <tr>
      <th>     </th>
      <th>Event</th>
      <th>Time</th>
      <th>Address</th>
      <th>Description</th>
      <th>Application</th>
    </tr>
  <?php
  foreach ($events as $event) {
    ?>
    <tr>
      <td>
      <?php
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
        <?php
        echo "<form class=\"loginform\" action=\"application.php?event_id=".$event['id']."\" method=\"post\">";
        ?>
          <button type="submit" name="apply">Apply</button>
        </form>
      </td>
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
      print_events($allevents);
  ?>
</div>
<?php include('includes/footer.php')?>
</body>
</html>
