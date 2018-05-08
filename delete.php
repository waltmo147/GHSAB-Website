<?php include('includes/init.php');
$current_page = "";
$current_member = $_GET['member'];
if(isset($_GET['delete_member'])){
  remove_member($current_member);
  record_message("removed member!");
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
<?php
print_messages();
?>
<div>


</body>
<?php include('includes/footer.php'); ?>
</html>
