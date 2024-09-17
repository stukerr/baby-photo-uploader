<?php
$uploadDir = 'uploads/';
$babyName = isset($_GET['baby_name']) ? $_GET['baby_name'] : 'UnknownBaby';
$babyFolder = $uploadDir . preg_replace('/[^A-Za-z0-9_\-]/', '_', $babyName) . '/';
$months = [
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
];

$uploadedFiles = glob($babyFolder . '*');

if (count($uploadedFiles) === 0) {
    echo "<p>No images uploaded yet.</p>";
} else {
    echo "<h2>Confirm Uploaded Images for $babyName</h2>";
    echo "<form action='process_images.php' method='post' enctype='multipart/form-data'>";

    foreach ($uploadedFiles as $index => $filePath) {
        if (is_file($filePath)) {
            $fileName = basename($filePath);
            $monthLabel = isset($months[$index]) ? $months[$index] : 'Unknown Month';

            echo "<div style='margin-bottom: 20px;'>";
            echo "<h3>Month: $monthLabel</h3>";
            echo "<img src='$babyFolder$fileName' alt='$monthLabel' style='max-width: 200px;'><br>";
            echo "<label>Replace this image: <input type='file' name='replace_image_$index'></label>";
            echo "</div>";
        }
    }

    echo "<input type='submit' value='Confirm and Proceed'>";
    echo "</form>";
}
?>
