<?php
// Directory where the uploaded images are stored
$uploadDir = 'uploads/';

// Array of month names for easy labeling
$months = [
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
];

// Get all uploaded images
$uploadedFiles = glob($uploadDir . '*');

// Check if there are any uploaded images
if (count($uploadedFiles) === 0) {
    echo "<p>No images uploaded yet.</p>";
} else {
    echo "<h2>Confirm Uploaded Images</h2>";
    echo "<form action='process_images.php' method='post'>"; // Example of form for further processing

    foreach ($uploadedFiles as $index => $filePath) {
        if (is_file($filePath)) {
            // Get file info
            $fileName = basename($filePath);
            $monthLabel = isset($months[$index]) ? $months[$index] : 'Unknown Month';

            // Display the image and a label
            echo "<div style='margin-bottom: 20px;'>";
            echo "<h3>Month: $monthLabel</h3>";
            echo "<img src='$uploadDir$fileName' alt='$monthLabel' style='max-width: 200px;'><br>";
            echo "<label>Replace this image: <input type='file' name='replace_image_$index'></label>";
            echo "</div>";
        }
    }

    echo "<input type='submit' value='Confirm and Proceed'>";
    echo "</form>";
}
?>
