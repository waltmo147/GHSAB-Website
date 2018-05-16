<?php
const MAX_FILE_SIZE = 1000000000;
const BOX_EVENTS_PATH = "uploads/events/";

$pages = array("Home" => "index.php",
               "Events" => "events.php",
               "Blog" => "blog.php",
               "About Us" => "aboutus.php",
               "Join Our Team" => "apply.php");
$adminpages = array("Home" => "index.php",
                    "Events" => "events.php",
                    "Blog" => "blog.php",
                    "About Us" => "aboutus.php",
                    "Edit Home Texts" => "admin-home.php",
                    "Edit Logo" => "admin_logo.php",
                    "Edit Slides" => "admin-slides.php",
                    "Edit Events" => "admin_event.php",
                    "Edit Blogs" => "admin-blogs.php",
                    "Edit About Us" => "admin-aboutus.php",
                    "Logout" => "logout.php");
$image_ext = array("jpg", "jpeg", "png", "gif");

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
  if (isset($_SESSION['current_user'])) {
    return $_SESSION['current_user'];
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
        if (password_verify($password, $account['password'])) {
          // generate new session
          session_regenerate_id();
          $_SESSION['current_user'] = $username;
          record_message("Logged in as $username.");
          return $username;
        } else {
          record_message("Invalid username or password.");
        }
      } else {
        record_message("Invalid username or password.");
      }
    } else {
      record_message("No username or password given.");
    }
    return NULL;


}

function log_out() {

  global $current_user;
  $current_user = NULL;
  // destroy PHP session
  unset($_SESSION['current_user']);
  session_destroy();


}


// open connection to database
$db = open_or_init_sqlite_db("website.sqlite", "init/init.sql");

// Check if we should login the user
session_start();
if (isset($_POST['login'])) {
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $username = trim($username);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

  // log_in($username, $password);

$current_user = log_in($username, $password);
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
