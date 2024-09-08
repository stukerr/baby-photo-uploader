<?php
session_start();
if (!isset($_SESSION['uploaded_files']) || !isset($_SESSION['baby_name'])) {
    header('Location: index.php');
    exit();
}

$uploaded_files = $_SESSION['uploaded_files'];
$baby_name = $_SESSION['baby_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Uploads</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>Confirm Uploaded Photos for <?php echo htmlspecialchars($baby_name); ?></h1>
        <div class="row">
            <?php foreach ($uploaded_files as $index => $file): ?>
                <div class="col-md-4 mb-3">
                    <img src="<?php echo $file; ?>" alt="Month <?php echo $index + 1; ?>" class="img-fluid">
                    <p>Month <?php echo $index + 1; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        
        <form action="send_email.php" method="POST">
            <button type="submit" class="btn btn-success">Confirm & Send</button>
        </form>
    </div>
</body>
</html>
