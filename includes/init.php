<?php

$pages = array("Home" => "index.php",
               "Events" => "events.php",
               "Applications" => "applications.php",
               "Blog" => "blog.php",
               "About Us" => "aboutus.php");
$adminpages = array("Home" => "index.php",
                    "Events" => "events.php",
                    "Applications" => "applications.php",
                    "Blog" => "blog.php",
                    "About Us" => "aboutus.php",
                    "Edit Logo" => "admin-logo.php",
                    "Edit Slides" => "admin-slides.php",
                    "Edit Events" => "admin-events.php",
                    "Applications" => "admin-applications.php",
                    "Edit Blogs" => "admin-blogs.php",
                    "Edit About Us" => "admin-aboutus.php",
                    "Logout" => "logout.php");

// An array to deliver messages to the user.
$messages = array();

// Record a message to display to the user.
function record_message($message) {
  global $messages;
  array_push($messages, $message);
}

// Write out any messages to the user.
function print_messages() {
  global $messages;
  foreach ($messages as $message) {
    echo "<p><strong>" . htmlspecialchars($message) . "</strong></p>\n";
  }
}


// show database errors during development.
function handle_db_error($exception) {
  echo '<p><strong>' . htmlspecialchars('Exception : ' . $exception->getMessage()) . '</strong></p>';
}

// execute an SQL query and return the results.
function exec_sql_query($db, $sql, $params = array()) {
  try {
    $query = $db->prepare($sql);
    if ($query and $query->execute($params)) {
      return $query;
    }
  } catch (PDOException $exception) {
    handle_db_error($exception);
  }
  return NULL;
}

// YOU MAY COPY & PASTE THIS FUNCTION WITHOUT ATTRIBUTION.
// open connection to database
function open_or_init_sqlite_db($db_filename, $init_sql_filename) {
  if (!file_exists($db_filename)) {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db_init_sql = file_get_contents($init_sql_filename);
    if ($db_init_sql) {
      try {
        $result = $db->exec($db_init_sql);
        if ($result) {
          return $db;
        }
      } catch (PDOException $exception) {
        // If we had an error, then the DB did not initialize properly,
        // so let's delete it!
        unlink($db_filename);
        throw $exception;
      }
    }
  } else {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  }
  return NULL;
}

function check_login() {
  global $db;

  if (isset($_COOKIE["session"])) {
    $session = $_COOKIE["session"];

    $sql = "SELECT * FROM admin WHERE session = :session";
    $params = array(
      ':session' => $session
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      // Username is UNIQUE, so there should only be 1 record.
      $account = $records[0];
      return $account['username'];
    }
  }
  return NULL;
}

function log_in($username, $password) {
  global $db;

  if ($username && $password) {
    $sql = "SELECT * FROM admin WHERE username = :username;";
    $params = array(
      ':username' => $username
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      // Username is UNIQUE, so there should only be 1 record.
      $account = $records[0];

      // Check password against hash in DB
      if ( password_verify($password, $account['password']) ) {

        // Generate session
        // Warning! Not a secure method for generating session IDs!
        // TODO: secure session
        $session = uniqid();
        $sql = "UPDATE admin SET session = :session WHERE admin_id = :user_id;";
        $params = array(
          ':user_id' => $account['admin_id'],
          ':session' => $session
        );
        $result = exec_sql_query($db, $sql, $params);
        if ($result) {
          // Success, we are logged in.

          // Send this back to the user.
          setcookie("session", $session, time()+3600);  /* expire in 1 hour */

          record_message("Logged in as $username.");
          header("Refresh:0 url=login.php");
          return TRUE;
        } else {
          record_message("Log in failed.");
        }
      } else {
        record_message("Invalid username or password.");
      }
    } else {
      record_message("Invalid username or password.");
    }
  } else {
    record_message("No username or password given.");
  }
  return FALSE;

}

function log_out() {
  global $current_user;
  global $db;

  if ($current_user) {
    $sql = "UPDATE admin SET session = :session WHERE username = :username;";
    $params = array(
      ':username' => $current_user,
      ':session' => NULL
    );
    if (!exec_sql_query($db, $sql, $params)) {
      record_message("Log out failed.");
    }
  }
  // Remove the session from the cookie and force it to expire.
  setcookie("session", "", time()-3600);
  $current_user = NULL;
  header("Refresh:0 url=logout.php");
}


// open connection to database
$db = open_or_init_sqlite_db("website.sqlite", "init/init.sql");

// Check if we should login the user
if (isset($_POST['login'])) {
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $username = trim($username);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

  log_in($username, $password);
}

// check if logged in
$current_user = check_login();
$current_user_id = NULL;
if ($current_user) {
  $sql = "SELECT admin_id FROM admin WHERE username = :username";
  $params = array(
    ':username' => $current_user
  );
  $records = exec_sql_query($db, $sql, $params)->fetchAll(PDO::FETCH_COLUMN);
  if ($records) {
    // Username is UNIQUE, so there should only be 1 record.
      $current_user_id = $records[0];
  }
}
?>
