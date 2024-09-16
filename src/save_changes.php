<?php
$uploadsDir = 'uploads/';

for ($i = 1; $i <= 12; $i++) {
    if (isset($_FILES["replace_image_$i"]) && $_FILES["replace_image_$i"]["error"] == 0) {
        $filePath = $uploadsDir . "baby_image_$i.jpg"; // Same naming convention
        move_uploaded_file($_FILES["replace_image_$i"]["tmp_name"], $filePath);
    }
}

echo "Images updated successfully.";
?>
