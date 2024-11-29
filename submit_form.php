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
    if ($resumePath) {
        $emailBody .= "Resume: Attached at $resumePath\n";
    }

    $headers = "From: $email";

    if (mail($to, $subject, $emailBody, $headers)) {
        header("Location: join-us.php?message=Thank you for contacting us!");
    } else {
        header("Location: join-us.php?error=Sorry, something went wrong. Please try again.");
    }
    exit;
} else {
    header("Location: join-us.php");
    exit;
}
