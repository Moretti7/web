<?php
$dir = "../../public/images";
$filename = $_FILES["avatar"]["name"];
$path = $dir . "/" . $filename;
move_uploaded_file($_FILES["avatar"]["tmp_name"], $path);

$response = [];

$response['photo'] = $path;

echo json_encode($response);
?>