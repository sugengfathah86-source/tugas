<?php

require_once "Downloader.php";

$start = microtime(true);

$files = [
    new Downloader("File A", 3),
    new Downloader("File B", 1),
    new Downloader("File C", 2)
];

$children = [];

foreach ($files as $file) {
    $pid = pcntl_fork();

    if ($pid == -1) {
        die("Gagal membuat proses");
    } elseif ($pid) {
        // Parent process
        $children[] = $pid;
    } else {
        // Child process (menjalankan downloader)
        $file->run();
        exit(0);
    }
}

// Tunggu semua child selesai
foreach ($children as $pid) {
    pcntl_waitpid($pid, $status);
}

$end = microtime(true);

echo "Total waktu multithreading: " . round($end - $start, 3) . " detik\n";
