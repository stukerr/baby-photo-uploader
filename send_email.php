<?php
session_start();
if (!isset($_SESSION['uploaded_files']) || !isset($_SESSION['baby_name'])) {
    header('Location: index.php');
    exit();
}

$baby_name = $_SESSION['baby_name'];
$uploaded_files = $_SESSION['uploaded_files'];
$to = "example@example.com";
$subject = "Baby Photos: " . $baby_name;
$headers = "From: no-reply@example.com";

$message = "Baby photos attached for " . $baby_name . ".";

$boundary = md5("random");

$headers .= "\nMIME-Version: 1.0\n" .
            "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"";

$email_message = "--" . $boundary . "\n" .
                 "Content-Type: text/plain; charset=\"UTF-8\"\n" .
                 "Content-Transfer-Encoding: 7bit\n\n" .
                 $message . "\n";

foreach ($uploaded_files as $file) {
    $file_name = basename($file);
    $file_data = chunk_split(base64_encode(file_get_contents($file)));
    
    $email_message .= "--" . $boundary . "\n" .
                      "Content-Type: application/octet-stream; name=\"" . $file_name . "\"\n" .
                      "Content-Disposition: attachment; filename=\"" . $file_name . "\"\n" .
                      "Content-Transfer-Encoding: base64\n\n" .
                      $file_data . "\n";
}

$email_message .= "--" . $boundary . "--";

if (mail($to, $subject, $email_message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email!";
}
?>
