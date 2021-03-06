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
    </tr>
  <?php
  foreach ($events as $event) {
    ?>
    <tr>
      <td class='apply'>
      <?php
      if ($event["image"] != NULL) {
        $image_file = "uploads/events/".$event["id"].".".$event["image"];

      } else {
        $image_file = "uploads/logo/logo.png";
      }

      //echo $image_file;
      echo "<img src=".htmlspecialchars($image_file)." alt=' ' width=120 height=120> ";
      ?>
      </td>
      <td class="name"><?php echo htmlspecialchars($event["name"]);?></td>
      <td class="date_time"> <?php echo htmlspecialchars($event["date_time"]); ?> </td>
      <td class="address"> <?php echo htmlspecialchars($event["address"]); ?> </td>
      <td class="description"> <?php echo htmlspecialchars($event["description"]); ?> </td>
      </td>
    </tr>
    <?php
  }
  echo "</table>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>Events</title>
</head>

<body>
<?php
include('includes/header.php');
include('includes/sidebar.php');
?>
<div class='show_events'>
  <h3>Upcoming Events</h3>
  <?php
      print_events($allevents);
  ?>
</div>
<?php include('includes/footer.php')?>
</body>
</html>
