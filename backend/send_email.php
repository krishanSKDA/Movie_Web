<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if (isset($_POST['submitForm'])) {
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comments = $_POST['comments'];

   
    $formData = [
        'firstName' => $firstname,
        'lastName' => $lastname,
        'email' => $email,
        'phone' => $phone,
        'comments' => $comments,
        'submitted_at' => date('Y-m-d H:i:s') 
    ];

   
    $jsonFilePath = '../backend/submitForm.json'; 
    if (file_exists($jsonFilePath)) {
        $existingData = json_decode(file_get_contents($jsonFilePath), true);
    } else {
        $existingData = [];
    }
    $existingData[] = $formData;

   
    file_put_contents($jsonFilePath, json_encode($existingData, JSON_PRETTY_PRINT));

    
    $mail = new PHPMailer(true);

    try {
       
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kdanushka917@gmail.com';
        $mail->Password = 'qxqzkbgqfirocwhg'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('kdanushka917@gmail.com', 'Movie Web');
        $mail->addAddress('kdanushka917@gmail.com', 'Movie Web');
        $mail->addAddress('dumindu.kodithuwakku@ebeyonds.com', 'Movie Web');
        $mail->addAddress('prabhath.senadheera@ebeyonds.com', 'Movie Web');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New enquiry for Movie Web';
        $mail->Body = '<h3>Hello, you got a new enquiry for Movie Web</h3>
            <h4>Full Name: ' . htmlspecialchars($firstname) . ' ' . htmlspecialchars($lastname) . '</h4>
            <h4>Email: ' . htmlspecialchars($email) . '</h4>
            <h4>Phone Number: ' . htmlspecialchars($phone) . '</h4>
            <h4>Comments: ' . htmlspecialchars($comments) . '</h4>';

        if ($mail->send()) {
            $_SESSION['status'] = "Thank you for contacting us. - Team Movie Web!";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit(0);
        } else {
            $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit(0);
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    header('Location: index.php');
    exit(0);
}
