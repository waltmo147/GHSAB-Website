<?php include('includes/init.php');
$current_page = "Home";?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <title>Home</title>
</head>

<body>
<?php include('includes/header.php');
include('includes/sidebar.php');
?>
<div class = "indexbody">
<div class="slideshow-container">

<?php
$sql = "SELECT * FROM slideshow";
$params = array();

$pictures = exec_sql_query($db,$sql,$params)->fetchAll();
$i=0;
foreach($pictures as $picture){
      $i+=1;
    echo "<div class='mySlides fade'>
      <div class='numbertext'>".htmlspecialchars($i)."</div>
      <img class = 'slideimg' alt='' src=". htmlspecialchars($picture['picpath']) . ">
      <div class='text'>". htmlspecialchars($picture['title']) . "</div>
    </div>";
}
?>

<a class="prev" onclick="nextSlide(-1)">&#10094;</a>
<a class="next" onclick="nextSlide(1)">&#10095;</a>

<div class = "dotalign">
  <?php
  $j = 1;
  while($i>=$j){
    echo("<span class='dot' onclick='gotoslide(".htmlspecialchars($j).")'></span>");
    $j+=1;
  }?>
</div>
</div>
<div class = "indextext">
  <?php
    $sql = "SELECT * FROM maindescription";
    $params = array();
    $text = exec_sql_query($db,$sql,$params)->fetchAll();
    foreach($text as $bodyelement){
      $title = $bodyelement['title'];
      $body = $bodyelement['body'];
      $body = explode(PHP_EOL, $body);
      echo("<h1>".htmlspecialchars($title)."</h1>");
      foreach($body as $par){
        echo("<p>".htmlspecialchars($par)."</p>");
      }
    }
  ?>
</div>
</div>
<br>

<script>
var slindex = 1;
slidedisplay(slindex);
function nextSlide(n) {
  slidedisplay(slindex += n);
}
function gotoslide(n) {
  slidedisplay(slindex = n);
}
function slidedisplay(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slindex = 1}
  if (n < 1) {slindex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slindex-1].style.display = "block";
  dots[slindex-1].className += " active";
}


</script>
<?php include('includes/footer.php'); ?>
</body>

</html>
