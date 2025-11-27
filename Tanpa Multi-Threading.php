<?php

$start = microtime(true);

function download($name, $time) {
    echo "$name mulai...\n";
    sleep($time);
    echo "$name selesai!\n";
}

download("File A", 3);
download("File B", 2);
download("File C", 1);

$end = microtime(true);
echo "\nWaktu total (tanpa thread): " . round($end - $start, 3) . " detik";
