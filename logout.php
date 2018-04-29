<?php
include("includes/init.php");


// declare the current location, utilized in header.php
$current_page_id="logout";

if (!$current_user) {
  record_message("You've been successfully logged out.");
} else {
  log_out();
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Log out- <?php echo $title;?></title>
</head>

<body>
  <?php
  include("includes/header.php");
  include('includes/sidebar.php');
  ?>
  
  <div id="logout">
    <h1>Log Out</h1>

    <?php
    print_messages();
    ?>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
