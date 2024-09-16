<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Uploaded Images</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .image-container {
            position: relative;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .image-container img {
            width: 100%;
            height: auto;
            display: block;
        }
        .replace-button {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }
        .replace-button:hover {
            background-color: #0056b3;
        }
        .file-input {
            display: none;
        }
    </style>
</head>
<body>

<h1>Confirm Uploaded Images</h1>

<form action="save_changes.php" method="POST" enctype="multipart/form-data">
    <div class="image-grid">
        <?php
        $uploadsDir = 'uploads/';
        for ($i = 1; $i <= 12; $i++) {
            $filePath = $uploadsDir . "baby_image_$i.jpg"; // Assuming the naming convention
            if (file_exists($filePath)) {
                echo "
                <div class='image-container'>
                    <img src='$filePath' alt='Month $i Image'>
                    <button type='button' class='replace-button' onclick='replaceImage($i)'>Replace Image</button>
                    <input type='file' name='replace_image_$i' id='replace_image_$i' class='file-input' onchange='previewImage(this, $i)'>
                </div>";
            }
        }
        ?>
    </div>
    <br>
    <div style="text-align: center;">
        <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
            Save Changes
        </button>
    </div>
</form>

<script>
    // Function to trigger file input for replacing images
    function replaceImage(month) {
        document.getElementById('replace_image_' + month).click();
    }

    // Function to show the selected image before uploading
    function previewImage(input, month) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // Find the image element and change its source to the new file
                document.querySelector('img[src*="baby_image_' + month + '"]').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]); // Read the new image file as a data URL
        }
    }
</script>

</body>
</html>
