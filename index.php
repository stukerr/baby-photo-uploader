<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baby Photo Uploader</title>
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Baby's First Year Photo Uploader</h1>
        <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="babyName" class="form-label">Baby's Name</label>
                <input type="text" class="form-control" id="babyName" name="baby_name" required>
            </div>
            
            <div class="row">
                <?php for($i = 1; $i <= 12; $i++): ?>
                    <div class="col-md-4 mb-3">
                        <label for="month_<?php echo $i; ?>" class="form-label">Month <?php echo $i; ?></label>
                        <input type="file" class="form-control" id="month_<?php echo $i; ?>" name="month_<?php echo $i; ?>" accept="image/*" required>
                    </div>
                <?php endfor; ?>
            </div>
            
            <button type="submit" class="btn btn-primary">Upload Photos</button>
        </form>
    </div>
    
    <script src="assets/script.js"></script>
</body>
</html>
