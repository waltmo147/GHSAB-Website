<?php
include("includes/init.php");


// declare the current location, utilized in header.php
$current_page="login";

// Set maximum file size for uploaded files.
// MAX_FILE_SIZE must be set to bytes
// 1 MB = 1000000 bytes


function printLoginForm() {
  ?>
  <form class="loginform" action="login.php" method="post">
    <ul>
      <li>
        <label>Username:</label>
        <input type="text" name="username" required/>
      </li>
      <li>
        <label>Password:</label>
        <input type="password" name="password" required/>
      </li>
      <li>
        <button name="login" type="submit">Log In</button>
      </li>
      </ul>
  </form>
  <?php
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Log in- <?php echo $title;?></title>
</head>

<body>
  <?php include("includes/header.php");
  include('includes/sidebar.php');
  ?>


  <div id="content-wrap">
    <h1>Log in</h1>

    <?php
    print_messages();

    if (!$current_user) {
      printLoginForm();
    } else {
      // printUploadForm();
      echo "Logged in as ".htmlspecialchars($current_user);
    }
    ?>


  </div>
</body>
<?php include("includes/footer.php");?>

</html>
