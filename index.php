<?php
require __DIR__ . '/vendor/autoload.php';

use route\Route;

try {
    $api = new Route();
    echo $api->run();
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}