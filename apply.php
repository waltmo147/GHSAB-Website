<?php include('includes/init.php');


$current_page = "Join Our Team";

$showForm = TRUE;


// echo("TO THE GRADERS: DEPENDCY IS REQUIRED FOR THIS FUNCTIONALITY... DID NOT WANT TO UPLOAD A PHP LIBRARY TO GITHUB");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';



if(isset($_POST['sendEmail'])){

//
//
// ///Users/barrondubois/github/red-lion-project-4/PHPMailer-master
// require_once('path/to/file/class.phpmailer.php');
//
// echo("Hello there");
//
//
//
//







            $upload_infoResume = $_FILES["resume"];
            $upload_infoCoverLetter = $_FILES["coverLetter"];

            if(($upload_infoResume['error'] == UPLOAD_ERR_OK) && $upload_infoCoverLetter['error'] == UPLOAD_ERR_OK ) {



          $applicantFirstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
          $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
          $phoneNumber = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_STRING);
          $emailAddress = filter_input(INPUT_POST, 'emailAddress', FILTER_SANITIZE_STRING);



// $message = wordwrap($message, 70, "\r\n");





          //UNCOMMENT THIS , THIS IS THE REAL STUFF
          $bodytext = "An application has been submitted by: $applicantFirstName $lastName \r\n Applicant's Phone Number: $phoneNumber \r\n Applicant's Email Address: $emailAddress \r\n Applicant's documents are attached below";
          $email = new PHPMailer();
          $email->From      = 'applicationmailer@gmail.com';
          $email->FromName  = 'New Applicant';
          $email->Subject   = 'Application';
          $email->Body      = $bodytext;


          //CHANGE THE EMAIL TO THE STUDENT ADVISORY BOARD EMAIL
          $email->AddAddress('dubois.barron@gmail.com');
          $email->AddAttachment( $_FILES['resume']['tmp_name'] , $applicantFirstName . $lastName . 'resume' . '.pdf' );
          $email->AddAttachment( $_FILES['resume']['tmp_name'], $applicantFirstName . $lastName . 'coverletter' . '.pdf' );
          $email->Send();

          array_push($messages, "Thanks for submitting your application! If your resume matches our needs a member of our organization will contact you.");


          $showForm = FALSE;

          }
}

?>





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
include('includes/footer.php');
?>




  <!-- <h2> ................. TO THE GRADERS: A DEPENDCY IS REQUIRED FOR THIS FUNCTIONALITY <h2> -->
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
            <input type="text" name="emailAddress" required>
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

            What is your current extracurricular involvement? Please list and indicate approximate time commitment.
            <textarea name="extracurricular" rows="10" cols="30" required> </textarea>
            <br>
            <br>

            What skills (i.e. computer programming, graphic design, etc.) have you developed that would benefit the Global Health Student Advisory Board?  Response should be 150 words or less.
            <br>
            <textarea name="applicantSkills" rows="10" cols="30" maxlength="150"> </textarea>
            <br>
            <br>


            What skills would you like to develop through being a member of the Global Health Student Advisory Board?  Please briefly explain.  Response should be 150 words or less.
            <br>
            <textarea name="learnSkills" rows="10" cols="30" maxlength="150"> </textarea>

            <br>
            <br>




            Personal Statement: Why are you interested in representing the Global Health Program and assisting with its development?  In your response, please describe your experiences in the Global Health Program and how they have shaped your Cornell experience and/or your career goals.  Responses should be 500 words or less.
            <br>
            <textarea name="applicantStatement" rows="10" cols="30" maxlength="500"> </textarea>

            <br>
            <br>



            <!-- <br>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE;?>" />
            <label> Upload Resume: </label>
            <input type="file" name="resume" required>
            <br>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE;?>" />
            <label> Upload Cover Letter: </label>
            <input type="file" name="coverLetter" required> -->














            <br>







            <label> Copy and Paste Resume Text Below: </label>
            <br>
            <textarea name="resumeText" rows="10" cols="30" required> </textarea>
            <br>



            <br>

            <button name="sendEmail" type="submit">Submit!</button>

  </form>


<?php } ?>



</div>


</body>
</html>
