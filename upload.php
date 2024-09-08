<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $baby_name = $_POST['baby_name'];
    $uploads_dir = 'uploads/' . $baby_name;
    
    if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }

    $files = [];
    for ($i = 1; $i <= 12; $i++) {
        $file_tmp = $_FILES['month_' . $i]['tmp_name'];
        $file_name = 'month_' . $i . '.jpg';
        $file_dest = $uploads_dir . '/' . $file_name;

        if (move_uploaded_file($file_tmp, $file_dest)) {
            $files[] = $file_dest;
        }
    }

    session_start();
    $_SESSION['uploaded_files'] = $files;
    $_SESSION['baby_name'] = $baby_name;

    header('Location: confirm.php');
    exit();
}
?>
