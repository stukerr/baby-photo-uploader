<?php
$uploadDir = 'uploads/';
$smbShare = '/mnt/stuworking/';
$babyName = isset($_POST['baby_name']) ? $_POST['baby_name'] : 'UnknownBaby';
$babyFolder = $uploadDir . preg_replace('/[^A-Za-z0-9_\-]/', '_', $babyName) . '/';
$smbBabyFolder = $smbShare . preg_replace('/[^A-Za-z0-9_\-]/', '_', $babyName) . '/';

// Create folder on SMB share
if (!is_dir($smbBabyFolder)) {
    mkdir($smbBabyFolder, 0777, true);
}

$months = [
    '01_January', '02_February', '03_March', '04_April', '05_May', '06_June',
    '07_July', '08_August', '09_September', '10_October', '11_November', '12_December'
];

$uploadedFiles = glob($babyFolder . '*');

foreach ($uploadedFiles as $index => $filePath) {
    if (is_file($filePath)) {
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        $monthPrefix = isset($months[$index]) ? $months[$index] : 'UnknownMonth';
        $newFileName = $monthPrefix . '.' . $fileExtension;
        $destinationFilePath = $smbBabyFolder . $newFileName;

        if (copy($filePath, $destinationFilePath)) {
            unlink($filePath);
        } else {
            echo "Failed to copy file: $filePath\n";
        }
    }
}

$to = getenv('EMAIL_TO') ?: 'default_email@example.com';
$subject = "Baby's Photos Uploaded";
$message = "Photos for $babyName have been uploaded to the SMB share.";
$headers = 'From: stu@stukerr.co.uk';

mail($to, $subject, $message, $headers);
?>
