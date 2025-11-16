<?php

require_once "Downloader.php";

$start = microtime(true);

$files = [
    new Downloader("File A", 3),
    new Downloader("File B", 1),
    new Downloader("File C", 2)
];

foreach ($files as $file) {
    $file->run();
}

$end = microtime(true);

echo "Total waktu tanpa multithreading: " . round($end - $start, 3) . " detik\n";
