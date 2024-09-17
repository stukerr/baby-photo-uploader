<?php
// Directory where the uploaded files are stored
$uploadDir = 'uploads/';

// Baby's name, which would ideally come from the form
$babyName = isset($_POST['baby_name']) ? $_POST['baby_name'] : 'UnknownBaby';

// SMB share mount point
$smbShare = '/mnt/smb_share/';

// Ensure the baby's name is sanitized for filesystem usage
$babyFolderName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $babyName); // Replaces any non-alphanumeric characters with underscores

// Destination folder on the SMB share (create a folder named after the baby)
$destinationDir = $smbShare . $babyFolderName . '/';

// Check if the destination directory exists; if not, create it
if (!is_dir($destinationDir)) {
    mkdir($destinationDir, 0777, true);
}

// Array of month names to preface the files
$months = [
    '01', '02', '03', '04', '05', '06',
    '07', '08', '09', '10', '11', '12'
];

// Get all uploaded files in the uploads directory
$uploadedFiles = glob($uploadDir . '*');

// Loop through all files, rename them with the month prefix, and copy to the SMB share
foreach ($uploadedFiles as $index => $filePath) {
    if (is_file($filePath)) {
        // Get the original file extension
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

        // Use the month name based on the file index
        $monthPrefix = isset($months[$index]) ? $months[$index] : 'UnknownMonth';

        // New file name with month prefix and original file extension
        $newFileName = $monthPrefix . '.' . $fileExtension;

        // Destination file path on the SMB share
        $destinationFilePath = $destinationDir . $newFileName;

        // Copy file to the SMB share
        if (copy($filePath, $destinationFilePath)) {
            // If the file was successfully copied, delete it from the uploads directory
            unlink($filePath);
        } else {
            echo "Failed to copy file: $filePath\n";
        }
    }
}

// Send an email notification
$to = getenv('EMAIL_TO') ?: 'default_email@example.com'; // Get email from environment variable or use a default
$subject = "Baby's Photos Uploaded";
$message = "Photos for $babyName have been uploaded to the SMB share.";
$headers = 'From: no-reply@yourdomain.com';

// Send the email
if (mail($to, $subject, $message, $headers)) {
    echo "Notification email sent successfully.";
} else {
    echo "Failed to send notification email.";
}

?>
