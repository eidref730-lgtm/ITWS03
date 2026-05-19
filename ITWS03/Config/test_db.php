<?php
require __DIR__ . '/../vendor/autoload.php';
$config = require __DIR__ . '/db.php';
try {
    new \Framework\Database($config);
    echo "DB-CONNECT-OK";
} catch (Exception $e) {
    echo "DB-CONNECT-ERROR: " . $e->getMessage();
}
