<?php
use route\api\Route;

try {
    $api = new Route();
    echo $api->run();
//    $api->run();
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}