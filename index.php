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
<<<<<<< HEAD
<?php include('includes/header.php');
include('includes/sidebar.php');
include('includes/footer.php');?>

<div class="slideshow-container">

<div class="Slides fade">
  <div class="numbertext">1 / 3</div>
  <img id = "slideimg" src="documents/IMG_7351.JPG">
  <div class="text">Caption Text</div>
</div>

<div class="Slides fade">
  <div class="numbertext">2 / 3</div>
  <img id = "slideimg" src="documents/IMG_7352.JPG">
  <div class="text">Caption Two</div>
</div>

<div class="Slides fade">
  <div class="numbertext">3 / 3</div>
  <img id = "slideimg" src="documents/IMG_7353.JPG">
  <div class="text">Caption Three</div>
</div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
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









=======
<?php include('includes/sidebar.php');
 include('includes/header.php');
 include("includes/footer.php");?>
>>>>>>> a49ad0abc559174a1d01a1a3f2e9570dbf8be211
</body>
</html>
