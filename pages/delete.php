<?php

$signedDir = '../signed/';
$uploadDir = '../uploads/';

if (isset($_GET['file'])) {

    $file = basename($_GET['file']); // security

    $signedPath = $signedDir . $file;

    if (file_exists($signedPath)) {

        // Extract original file name
        $originalName = str_replace('signed_', '', $file);

        $uploadPath = $uploadDir . $originalName;

        // Delete signed file
        unlink($signedPath);

        // Delete original file (if exists)
        if (file_exists($uploadPath)) {
            unlink($uploadPath);
        }

        header("Location: pdf-list.php");
        exit;

    } else {
        echo "File not found.";
    }
}