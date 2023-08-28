<?php
$imageFolderPath = '../assets/flash/';
$imagePaths = array();

if (is_dir($imageFolderPath)) {
    $files = scandir($imageFolderPath);
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $imagePaths[] = $imageFolderPath . $file;
        }
    }
}

$data = array(
    'images' => $imagePaths
);

header('Content-Type: application/json');
echo json_encode($data);
