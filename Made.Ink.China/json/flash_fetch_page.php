<?php
$imagesPerPage = 16;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$start = ($page - 1) * $imagesPerPage;

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

$totalImages = count($imagePaths);
$totalPages = ceil($totalImages / $imagesPerPage);
$imagesOnPage = array_slice($imagePaths, $start, $imagesPerPage);

$data = array(
    'images' => $imagesOnPage,
    'totalPages' => $totalPages
);

header('Content-Type: application/json');
echo json_encode($data);
