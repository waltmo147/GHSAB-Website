<?php include('includes/init.php');
$current_page = "Home";?>
<!DOCTYPE html>
<html>

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

<div class="slideshow-container">

<?php
$sql = "SELECT * FROM slideshow";
$params = array();

$pictures = exec_sql_query($db,$sql,$params)->fetchAll();
$i=0;
foreach($pictures as $picture){
      $i+=1;
    echo("<div class='mySlides fade'>
      <div class='numbertext'>$i</div>
      <img id = 'slideimg' src=". $picture['picpath'] . ">
      <div class='text'>". $picture['title'] . "</div>
    </div>");
}
?>

<a class="prev" onclick="nextSlide(-1)">&#10094;</a>
<a class="next" onclick="nextSlide(1)">&#10095;</a>

<div class = "dotalign">
  <?php
  $j = 1;
  while($i>=$j){
    echo("<span class='dot' onclick='gotoslide($j)'></span>");
    $j+=1;
  }?>
</div>
</div>
<br>

<script>
var slideIndex = 1;
displaySlides(slideIndex);
function nextSlide(n) {
  displaySlides(slideIndex += n);
}
function gotoslide(n) {
  displaySlides(slideIndex = n);
}
function displaySlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}


</script>
</body>
<?php include('includes/footer.php'); ?>
</html>
