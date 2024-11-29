<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $country = htmlspecialchars($_POST['country']);
    $city = htmlspecialchars($_POST['city']);
    $linkedin = htmlspecialchars($_POST['linkedin']);
    $additionalInfo = htmlspecialchars($_POST['additional_info']);

    $resumePath = "";
    $resumeName = "";
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $resumeName = basename($_FILES['resume']['name']);
        $resumePath = $uploadDir . time() . '_' . $resumeName;
        if (!move_uploaded_file($_FILES['resume']['tmp_name'], $resumePath)) {
            header("Location: join-us.php?error=Failed to upload resume.");
            exit;
        }
    }

    $to = "contact@softcode.se"; 
    $subject = "New Contact Form Submission";
    $emailBody = "You have received a new message:\n\n" .
                 "First Name: $firstName\n" .
                 "Last Name: $lastName\n" .
                 "Email: $email\n" .
                 "Phone: $phone\n" .
                 "Country: $country\n" .
                 "City: $city\n" .
                 "LinkedIn: $linkedin\n" .
                 "Additional Info: $additionalInfo\n";
    
    $boundary = md5(time());

    $headers = "From: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

    $message = "--$boundary\r\n";
    $message .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n";
    $message .= "$emailBody\r\n";

    if ($resumePath) {
        $fileContent = file_get_contents($resumePath);
        $fileContent = chunk_split(base64_encode($fileContent));

        $message .= "--$boundary\r\n";
        $message .= "Content-Type: application/octet-stream; name=\"$resumeName\"\r\n";
        $message .= "Content-Transfer-Encoding: base64\r\n";
        $message .= "Content-Disposition: attachment; filename=\"$resumeName\"\r\n";
        $message .= "$fileContent\r\n";
    }

    $message .= "--$boundary--";

    if (mail($to, $subject, $message, $headers)) {
        header("Location: join-us.php?message=Thank you for contacting us!");
    } else {
        header("Location: join-us.php?error=Sorry, something went wrong. Please try again.");
    }
    exit;
} else {
    header("Location: join-us.php");
    exit;
}
