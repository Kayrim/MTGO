<?php

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileError = $_FILES['file']['error'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowedTypes = ['txt', 'log'];

    if (in_array($fileActualExt, $allowedTypes)) {
        if ($fileError === 0) {
            if ($fileSize > 100000) {
                //uniqid("",true);
                $fileNameNew = "log." . $fileActualExt;
                $fileDestiation = 'uploads/' . $fileNameNew;

                move_uploaded_file($fileTmpName, $fileDestiation);
                header("Location: index.php");
            } else {
                echo "File too big to be a log";
            }
        } else {
            echo "There was an error uploading the file.";
        }
    } else {
        echo "You cannot upload files of this type.";
    }
}