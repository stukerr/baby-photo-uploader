<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baby Photo Uploader</title>
</head>
<body>
    <h1>Upload Baby Photos for First Year</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="baby_name">Baby's Name:</label>
        <input type="text" id="baby_name" name="baby_name" required><br><br>

        <?php for ($i = 1; $i <= 12; $i++): ?>
            <label for="month<?php echo $i; ?>">Month <?php echo $i; ?>:</label>
            <input type="file" id="month<?php echo $i; ?>" name="month<?php echo $i; ?>" required><br><br>
        <?php endfor; ?>

        <input type="submit" value="Upload Photos">
    </form>
</body>
</html>

