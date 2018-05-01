<?php include('includes/init.php');


$current_page = 'Events';



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


  <h1> Join our team! lk;asdfkl;;adls;kldfsaa;lkdfsadfskadaklf;kdafskdasf;kfd</h1>
  <br>
  <br>


<?php print_messages(); ?>


  <form id="submitApplication" action="apply.php" method="post" enctype="multipart/form-data">


            First name:
            <input type="text" name="firstName" required>
            <br>
            Last name:
            <input type="text" name="lastName" required>
            <br>
            Email address:
            <input type="text" name="emailAddress" required>
            <br>
            Phone Number:
            <input type="text" name="phoneNumber" required>
            <br>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE;?>" />
            <label> Upload Resume: </label>
            <input type="file" name="resume" required>
            <br>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE;?>" />
            <label> Upload Cover Letter: </label>
            <input type="file" name="coverLetter" required>
            <br>




            <button name="sendEmail" type="submit">Submit!</button>





  </form>









</body>
</html>
