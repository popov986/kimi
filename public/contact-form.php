<?php
/**
 * Contact form handler. Receives AJAX POST from the contact page,
 * sends email to the address in config, returns JSON.
 */
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

require_once __DIR__ . '/../includes/config.php';

$data = ['success' => false, 'message' => 'Error. Message not sent.'];
$emailTo = isset($contact_email) ? trim($contact_email) : '';

if ($emailTo === '') {
    echo json_encode($data);
    exit;
}

$values = isset($_POST['values']) && is_array($_POST['values']) ? $_POST['values'] : [];
$body = '';
$replyTo = '';

foreach ($values as $key => $val) {
    $v = is_array($val) ? trim((string) ($val[0] ?? '')) : trim((string) $val);
    if ($v !== '') {
        $body .= ucfirst($key) . ': ' . $v . "\n\n";
        if (in_array(strtolower($key), ['email', 'e-mail'], true)) {
            $replyTo = $v;
        }
    }
}

$domain = isset($_POST['domain']) ? preg_replace('/[^a-zA-Z0-9.-]/', '', $_POST['domain']) : 'website';
$subject = isset($_POST['subject_email']) && $_POST['subject_email'] !== ''
    ? trim($_POST['subject_email'])
    : '[' . $domain . '] New message from contact form';

$body .= "----------------------------------------\nSent from " . $domain;

$fromDomain = isset($_SERVER['HTTP_HOST']) ? preg_replace('/[^a-zA-Z0-9.-]/', '', $_SERVER['HTTP_HOST']) : 'noreply';
$fromEmail = 'noreply@' . $fromDomain;

$headers = "From: " . $fromEmail . "\r\n";
$headers .= "Reply-To: " . ($replyTo !== '' ? $replyTo : $fromEmail) . "\r\n";
$headers .= "X-Mailer: PHP/" . PHP_VERSION . "\r\n";
$headers .= "Content-Type: text/plain; charset=utf-8\r\n";

$sent = @mail($emailTo, $subject, $body, $headers);

if ($sent) {
    $data['success'] = true;
    $data['message'] = 'Congratulations. Your message has been sent successfully.';
}

echo json_encode($data);
