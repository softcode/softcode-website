<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';




function sendResponse($response, $statusCode = 200)
{
  http_response_code($statusCode);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($response);
}

function sendMail()
{

  $firstName = htmlspecialchars($_POST['first_name']);
  $lastName = htmlspecialchars($_POST['last_name']);
  $email = htmlspecialchars($_POST['email']);
  $phone = htmlspecialchars($_POST['phone']);
  $country = htmlspecialchars($_POST['country']);
  $city = htmlspecialchars($_POST['city']);
  $linkedin = htmlspecialchars($_POST['linkedin']);
  $additionalInfo = htmlspecialchars($_POST['additional_info']);

  $from = "rikard.hassel@softcode.se";
  $to = "contact@softcode.se";
  $subject = "New Contact Form Submission";
  $mail = new PHPMailer(true);

  if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
    $ext = PHPMailer::mb_pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
    //Define a safe location to move the uploaded file to, preserving the extension
    $uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['resume']['name'])) . '.' . $ext;


    if (!move_uploaded_file($_FILES['resume']['tmp_name'], $uploadfile)) {
      return "Failed to upload resume.";
    }
  }

  try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'softcode-se.mail.protection.outlook.com';
    $mail->Port = 25;
    $mail->SMTPAuth = false;
    $mail->SMTPSecure = false;

    // Recipient
    $mail->setFrom($from, 'Contact Form');
    $mail->addAddress($to); // Your email to receive the form data

    // Email content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = "You have received a new message:<br><br>" .
      "First Name: $firstName<br>" .
      "Last Name: $lastName<br>" .
      "Email: $email<br>" .
      "Phone: $phone<br>" .
      "Country: $country<br>" .
      "City: $city<br>" .
      "LinkedIn: $linkedin<br>" .
      "Additional Info: $additionalInfo<br>";

    //Attach the uploaded file
    if ($uploadfile && !$mail->addAttachment($uploadfile, 'Resume')) {
      return 'Failed to attach file ' . $_FILES['userfile']['name'];
    }

    // Send the email
    $mail->send();
    return true;
  } catch (Exception $e) {
    return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $result = sendMail();
  if ($result === true) {
    sendResponse('Message has been sent', $statusCode);
  } else {
    sendResponse($result, 400);
  }
} else {
  sendResponse("!!", 404);
}

exit;
