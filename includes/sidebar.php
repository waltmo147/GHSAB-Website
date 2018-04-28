<div id = "sidebar">
<img src='logo.png' alt='logo'>
<?php
$pages = array("Home" => "index.php",
               "Events" => "events.php",
               "Applications" => "applications.php",
               "Blog" => "blog.php",
               "About Us" => "aboutus.php");

foreach($pages as $name => $link){
  if ($name == $current_page) {
    $css_id = "id='current_page'";
  } else {
    $css_id = "";
  }
  echo "<a $css_id href= '$link'>$name</a>";
}
?>
</div>
