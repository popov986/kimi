<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// --- CONFIGURATION ---
$sender_email  = 'no-reply@kimi-trockenbau-innenausbau.de'; // domain email created in cPanel
$sender_pass   = 'ndlM}%)y5ucZ%kRd';                      // password of above email
$receiver_email= 'popov_vancho@yahoo.com';                  // where messages will be sent
$domain        = 'kimi-trockenbau-innenausbau.de';          // your domain

// Initialize response
$data   = [];
$errors = [];
$body   = '';
$email  = '';
$name   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $arr = $_POST['values'] ?? [];

    // Optional: override receiver and subject from form
    $subject = $_POST['subject_email'] ?? '['.$domain.'] New message';
    $emailTo = $_POST['email'] ?? $receiver_email;

    // Build message body
    foreach ($arr as $key => $value) {
        $val = is_array($value) ? trim($value[0]) : trim($value);
        $val = stripslashes($val);

        if (!empty($val)) {
            $body .= ucfirst($key) . ': ' . $val . PHP_EOL . PHP_EOL;

            if (in_array(strtolower($key), ['email', 'e-mail'])) $email = $val;
            if (in_array(strtolower($key), ['name', 'nome'])) $name = $val;
        }
    }

    // Validate email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email address';

    $body .= str_repeat('-', 80) . PHP_EOL;
    $body .= "New message from " . $domain;
    if ($name == '') $name = $subject;

    if (!empty($errors)) {
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {
        $mail = new PHPMailer(true);
        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host       = 'mail.kimi-trockenbau-innenausbau.de'; // cPanel mail server
            $mail->SMTPAuth   = true;
            $mail->Username   = $sender_email;
            $mail->Password   = $sender_pass;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->SMTPDebug = 2;       // shows connection and auth details
            $mail->Debugoutput = 'html'; // prints debug info in HTML

            // Email headers and content
            $mail->setFrom($sender_email, $domain);
            $mail->addAddress($emailTo);
            $mail->addReplyTo($email, $name); // reply goes to form sender

            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            $data['success'] = true;
            $data['message'] = 'Message sent successfully via SMTP.';
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    echo json_encode($data);
}