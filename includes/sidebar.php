<div id = "sidebar">
<img class='logo' src='uploads/logo/logo.png' alt='logo'>
<!-- <a href="uploads/logo/logo.png"> Our client owns the logo image</a> -->
<?php
if($current_user){
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
