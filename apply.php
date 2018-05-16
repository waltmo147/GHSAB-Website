<?php include('includes/init.php');
$current_page = "Join Our Team";
$showForm = TRUE;

if(isset($_POST['sendEmail'])){



          $applicantFirstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
          $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
          $phoneNumber = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_STRING);
          $applicantNETID = filter_input(INPUT_POST, 'netID', FILTER_SANITIZE_STRING);
          $applicantYear = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING);
          $applicantMajor = filter_input(INPUT_POST, 'major', FILTER_SANITIZE_STRING);
          $applicantCollege = filter_input(INPUT_POST, 'college', FILTER_SANITIZE_STRING);
          $applicantProgram = filter_input(INPUT_POST, 'program', FILTER_SANITIZE_STRING);
          $applicantField = filter_input(INPUT_POST, 'fieldLocation', FILTER_SANITIZE_STRING);
          $applicantCurric = filter_input(INPUT_POST, 'extracurricular', FILTER_SANITIZE_STRING);
          $applicantResume = filter_input(INPUT_POST, 'resumeText', FILTER_SANITIZE_STRING);
          $applicantSkills = filter_input(INPUT_POST, 'applicantSkills', FILTER_SANITIZE_STRING);
          $applicantLearnSkills = filter_input(INPUT_POST, 'learnSkills', FILTER_SANITIZE_STRING);
          $applicantStatement = filter_input(INPUT_POST, 'applicantStatement', FILTER_SANITIZE_STRING);


          $message = "Application from: " . $applicantFirstName . " " . $lastName . " (" . $applicantNETID . ")" . "\r\n";
          $lineTwo= "Applicant's phone number is: " . $phoneNumber . "\r\n";
          $lineThree = $applicantFirstName . " is a " . $applicantYear . " studying " . $applicantMajor . " in the College of " . $applicantCollege . "\r\n";
          $lineFour = $applicantFirstName . " is a part of the " . $applicantProgram . " program/organization and has done their field work in: " . $applicantField . "\r\n\r\n";
          $lineFive = "Prompts and Applicant Responses: \r\n\r\n";
          $lineSix = "What is your current extracurricular involvement? Please list and indicate approximate time commitment. \r\n\r\n";
          $linesSevens = wordwrap($applicantCurric, 70, "\r\n") . "\r\n\r\n";
          $lineEight = "What skills (i.e. computer programming, graphic design, etc.) have you developed that would benefit the Global Health Student Advisory Board? \r\n\r\n";
          $lineNine = wordwrap($applicantSkills, 70, "\r\n") . "\r\n\r\n";
          $lineTen = "What skills would you like to develop through being a member of the Global Health Student Advisory Board? \r\n\r\n";
          $lineEleven = wordwrap($applicantLearnSkills, 70, "\r\n") . "\r\n\r\n";
          $lineTwelve = "Personal Statement: Why are you interested in representing the Global Health Program and assisting with its development? \r\n\r\n";
          $lineThirteen = wordwrap($applicantStatement, 70, "\r\n") . "\r\n\r\n";
          $lineFourteen = "Copy and Paste Resume Text \r\n\r\n";
          $lineFifteen = wordwrap($applicantResume, 70, "\r\n") . "\r\n\r\n";

          $message = htmlspecialchars_decode($message . $lineTwo . $lineThree . $lineFour . $lineFive . $lineSix . $linesSevens . $lineEight . $lineNine . $lineTen . $lineEleven . $lineTwelve . $lineThirteen . $lineFourteen . $lineFifteen, ENT_QUOTES);


          if(mail("barronfran@gmail.com", "NEW APPLICATION FOR GHSAB", "$message")){
            array_push($messages, "Thanks for submitting your application! If your resume matches our needs a member of our organization will contact you.");
          } else {
            array_push($messages, "There was an error processing your application, please resubmit at your earliest convenience.");
          }
          $showForm = FALSE;

}

?>

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



  <br>
  <br>

<div id="applyFORM">

<h1> Join Our Team!</h1>

<?php print_messages(); ?>




<?php if($showForm){    ?>
  <form id="submitApplication" action="apply.php" method="post" enctype="multipart/form-data">
          <label> The Global Health Student Advisory Board (GHSAB) is a diverse group of dedicated, enthusiastic and innovative upperclassmen that represents the Global Health Program and assists with overall program development.  As Global Health Student Advisors, students work 2-3 hours per week on the development of Global Health programs, including: </label>
          <br>
          <br>


          <label> I. Organizing information sessions and other means of communicating various programs, </label>

          <br>

          <label> II. A Cornell Global Health Case Competition, and Experiential Learning Symposium </label>
          <br>

          <label> III. Standardized criterion for evaluating Independent Field Experience opportunities, and </label>
          <br>
          <label> IV. Organizing Global Health related workshops and various events. </label>
          <br>
          <br>
          <label> Please note that this list is just a sample. As a Global Health Student Advisor, you could work on all of these projects and more, including project ideas you come up with yourself! </label>
          <br>
          <br>
          <label> If you are interested in applying, please submit the following application by Monday, April 10 at 11:59 pm. </label>
          <br>
          <br>
          <label> Thank you for your interest! </label>
          <br>
          <label> For more information, contact Tatyana Roberts (tdr37), Global Health Program Fellow. </label>
          <br>
          <label> For questions, or issues with application submission, contact Katharine-Grace Norris (kn293). </label>
          <br>
          <br>


            First name:
            <input type="text" name="firstName" required>
            <br>

            Last name:
            <input type="text" name="lastName" required>
            <br>
            Phone Number:
            <input type="text" name="phoneNumber" required>
            <br>

            NetID:
            <input type="text" name="netID" required>
            <br>


            College:
            <input type="text" name="college" required>
            <br>

            Major:
            <input type="text" name="major" required>
            <br>

            Year (ex. Junior):
            <input type="text" name="year" required>
            <br>
            Field Experience Location. Note: Students who have not yet completed their Field Experience (but plan to during Summer 2017) are welcome to apply. However, final acceptance to the GHSAB is contingent upon successful completion of a Field Experience.
            <input type="text" name="fieldLocation" required>
            <br>
            Program/Organization:
            <input type="text" name="program" required>
            <br>
            <br>

            What is your current extracurricular involvement? Please list and indicate approximate time commitment Please explain in less than 500 characters.
            <br>
            <textarea name="extracurricular" rows="10" cols="30" maxlength="500"> </textarea>
            <br>
            <br>

            What skills (i.e. computer programming, graphic design, etc.) have you developed that would benefit the Global Health Student Advisory Board? Please explain in less than 500 characters.
            <br>
            <textarea name="applicantSkills" rows="10" cols="30" maxlength="500"> </textarea>
            <br>
            <br>


            What skills would you like to develop through being a member of the Global Health Student Advisory Board? Please briefly explain in less than 2000 characters.
            <br>
            <textarea name="learnSkills" rows="10" cols="30" maxlength="2000"> </textarea>

            <br>
            <br>




            Personal Statement: Why are you interested in representing the Global Health Program and assisting with its development?  In your response, please describe your experiences in the Global Health Program and how they have shaped your Cornell experience and/or your career goals. Please briefly explain in less than 2000 characters.
            <br>
            <textarea name="applicantStatement" rows="10" cols="30" maxlength="2000"> </textarea>

            <br>
            <br>
            <br>







            <label> Copy and Paste Resume Text Below: </label>
            <br>
            <textarea name="resumeText" rows="10" cols="30" maxlength="3000"> </textarea>
            <br>



            <br>

            <button name="sendEmail" type="submit">Submit!</button>

  </form>


<?php } ?>

</div>

<?php include('includes/footer.php'); ?>
</body>
</html>
