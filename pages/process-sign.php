<?php

require_once '../vendor/autoload.php';
use setasign\Fpdi\Fpdi;

if ($_FILES['pdf']['error'] === 0) {

    $uploadDir = '../uploads/';
    $signedDir = '../signed/';

    $fileName = uniqid() . '.pdf';
    $filePath = $uploadDir . $fileName;

    // move uploaded file
    move_uploaded_file($_FILES['pdf']['tmp_name'], $filePath);

    // create FPDI instance
    $pdf = new Fpdi();
    $pageCount = $pdf->setSourceFile($filePath);

    for ($i = 1; $i <= $pageCount; $i++) {
        $tpl = $pdf->importPage($i);
        $size = $pdf->getTemplateSize($tpl);

        $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
        $pdf->useTemplate($tpl);

        // add signature ONLY on last page
        if ($i === $pageCount) {
            $pdf->Image('../assets/signature.png', 
                $size['width'] / 2 - 30, 
                $size['height'] - 85, 
                60
            );
        }
    }

    $outputFile = $signedDir . 'signed_' . $fileName;
    $pdf->Output($outputFile, 'F');

    header("Location: /projects/sign-document/pages/pdf-list.php");
    exit;
}