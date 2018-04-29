<div id = "sidebar">
<img class="logo" src='documents/logo.png' alt='logo'>
<?php
$pages = array("Home" => "index.php",
               "Events" => "events.php",
               "Applications" => "applications.php",
               "Blog" => "blog.php",
               "About Us" => "aboutus.php");
$adminpages = array("Logo" => "logo.php",
                    "Slides" => "slides.php",
                    "Blogs" => "blogs.php",
                    "Applications" => "applications.php",
                    "Events" => "events.php",
                    "Logout" => "logout.php");
if($signedin){
  foreach($adminpages as $name => $link){
    if ($name == $current_page) {
      $css_id = "id='current_page'";
    } else {
      $css_id = "";
    }
    echo "<a $css_id href= '$link'>$name</a>";
  }
}
else{
  foreach($pages as $name => $link){
    if ($name == $current_page) {
      $css_id = "id='current_page'";
    } else {
      $css_id = "";
    }
    echo "<a $css_id href= '$link'>$name</a>";
  }
}
?>
</div>
