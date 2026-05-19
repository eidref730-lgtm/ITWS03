<?php
require __DIR__ . '/../vendor/autoload.php';
$config = require __DIR__ . '/db.php';
try {
    $db = new \Framework\Database($config);
    $keywords = $argv[1] ?? 'engineer';
    $location = $argv[2] ?? '';

    $query = "SELECT * FROM listings WHERE (title LIKE :keywords OR description LIKE :keywords OR tags LIKE :keywords OR company LIKE :keywords) AND (city LIKE :location OR state LIKE :location)";

    $params = [
        'keywords' => "%{$keywords}%",
        'location' => "%{$location}%"
    ];

    $sth = $db->query($query, $params);
    $rows = $sth->fetchAll();
    echo "Found: " . count($rows) . "\n";
    foreach ($rows as $r) {
        echo $r->id . ' - ' . ($r->title ?? '') . "\n";
    }
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . "\n";
}
