<?php
$uploadDir = 'uploads/';
$babyName = isset($_POST['baby_name']) ? $_POST['baby_name'] : 'UnknownBaby';
$babyFolder = $uploadDir . preg_replace('/[^A-Za-z0-9_\-]/', '_', $babyName) . '/';

// Create baby's folder if not exists
if (!is_dir($babyFolder)) {
    mkdir($babyFolder, 0777, true);
}

for ($i = 1; $i <= 12; $i++) {
    if (isset($_FILES["month$i"])) {
        $fileTmpPath = $_FILES["month$i"]['tmp_name'];
        $fileName = basename($_FILES["month$i"]['name']);
        $destPath = $babyFolder . "month_$i-" . $fileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            echo "Uploaded month $i photo successfully.<br>";
        } else {
            echo "Error uploading month $i photo.<br>";
        }
    }
}

header("Location: confirm.php?baby_name=" . urlencode($babyName));
exit;
?>
