<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../includes/config.php';

// Include PHPMailer files (paths must be absolute; server working directory can differ).
$phDir = __DIR__ . '/../PHPMailer';
require_once $phDir . '/src/Exception.php';
require_once $phDir . '/src/PHPMailer.php';
require_once $phDir . '/src/SMTP.php';

// --- CONFIGURATION ---
$sender_email  = 'no-reply@kimi-trockenbau-innenausbau.de'; // domain email created in cPanel
$sender_pass   = 'ndlM}%)y5ucZ%kRd';                      // password of above email
$receiver_email= $contact_email;                  // where messages will be sent
$domain        = 'kimi-trockenbau-innenausbau.de';          // your domain

// Initialize response
$data   = [];
$errors = [];
$body   = '';
$email  = '';
$name   = '';
$phone  = '';
$messageText = '';

//echo '<pre>';
//print_r($_REQUEST);
//die;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $arr = $_POST['values'] ?? [];

    // Optional: override receiver and subject from form.
    // `??` does not replace an empty string, so ensure we fallback when subject_email is ''.
    $subject = (isset($_POST['subject_email']) && trim((string) $_POST['subject_email']) !== '')
        ? trim((string) $_POST['subject_email'])
        : 'Web Page Contact Form';
    $emailTo = $_POST['email'] ?? $receiver_email;

    // Build message body
    foreach ($arr as $key => $value) {
        $val = is_array($value) ? trim($value[0]) : trim($value);
        $val = stripslashes($val);

        if (!empty($val)) {
            $body .= ucfirst($key) . ': ' . $val . PHP_EOL . PHP_EOL;

            if (in_array(strtolower($key), ['email', 'e-mail'])) $email = $val;
            if (in_array(strtolower($key), ['name', 'nome'])) $name = $val;
            if (strtolower($key) === 'phone') $phone = $val;
            if (strtolower($key) === 'messagge') $messageText = $val;
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
        // Build HTML email body from a simple template.
        // Note: user content is escaped to prevent HTML injection.
        $esc = static function ($v): string {
            return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
        };

        $htmlName = $esc($name);
        $htmlEmail = $esc($email);
        $htmlPhone = $esc($phone);
        $htmlDomain = $esc($domain);

        $htmlMessage = $esc($messageText);
        $htmlMessage = nl2br($htmlMessage);

        $htmlBody = '<!doctype html>'
            . '<html lang="en">'
            . '<head>'
            . '  <meta charset="utf-8" />'
            . '  <title>Web Page Contact Form - New message from: ' . $htmlName . '</title>'
            . '</head>'
            . '<body style="font-family: Arial, Helvetica, sans-serif; color:#222; background:#fff; margin:0; padding:0;">'
            . '  <div style="max-width:720px; margin:0 auto; padding:20px;">'
            . '    <h2 style="margin:0 0 14px; font-size:18px; color:#111;">Web Page Contact Form - New message from: ' . $htmlName . '</h2>'
            . '    <div style="border:1px solid #e6e6e6; border-radius:6px; padding:16px; margin-bottom:18px;">'
            . '      <p style="margin:0 0 10px;"><strong>Name:</strong> ' . $htmlName . '</p>'
            . '      <p style="margin:0 0 10px;"><strong>Email:</strong> ' . $htmlEmail . '</p>'
            . '      <p style="margin:0 0 10px;"><strong>Phone:</strong> ' . $htmlPhone . '</p>'
            . '      <p style="margin:0 0 6px;"><strong>Message:</strong></p>'
            . '      <div style="white-space:pre-wrap; line-height:1.4; padding:10px 12px; background:#fafafa; border-radius:4px;">'
            . '        ' . $htmlMessage
            . '      </div>'
            . '    </div>'
            . '  </div>'
            . '</body>'
            . '</html>';

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
            // Keep debug output off so the AJAX handler always returns clean JSON.
            $mail->SMTPDebug = 0;

            // Email headers and content
            $mail->setFrom($sender_email, $domain);
            $mail->addAddress($emailTo);
            $mail->addReplyTo($email, $name); // reply goes to form sender

            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body    = $htmlBody;
            $mail->AltBody = $body;

            $mail->send();
            $data['success'] = true;
            $data['message'] = 'Message sent successfully via SMTP.';

            error_log(
                '[contact-form] PHPMailer sent=1 to=' . $emailTo .
                ' subject=' . $subject .
                ' msgid=' . ($mail->getLastMessageID() ?: '-')
            );
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            error_log(
                '[contact-form] PHPMailer sent=0 to=' . ($emailTo ?? '-') .
                ' subject=' . ($subject ?? '-') .
                ' err=' . ($mail->ErrorInfo ?? $e->getMessage())
            );
        }
    }

    echo json_encode($data);
}