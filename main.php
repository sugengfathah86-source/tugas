<?php

class Downloader {
    public $fileName;
    public $delay;

    public function __construct($fileName, $delay) {
        $this->fileName = $fileName;
        $this->delay = $delay;
    }
}

$downloads = [
    new Downloader("File A", 3),
    new Downloader("File B", 1),
    new Downloader("File C", 2)
];

$mode = "multi";   
if ($mode === "multi") {

    echo "=== MODE MULTI-THREADING (SIMULASI) ===\n";

    $start = microtime(true);

    $mh = curl_multi_init();
    $curlHandles = [];

    foreach ($downloads as $d) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://httpbin.org/delay/" . $d->delay);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_multi_add_handle($mh, $ch);

        $curlHandles[(int)$ch] = $d->fileName;

        echo $d->fileName . " mulai diunduh...\n";
    }
    do {
        $status = curl_multi_exec($mh, $active);
        curl_multi_select($mh);
    } while ($active > 0);

    // Selesai
    foreach ($curlHandles as $ch => $name) {
        echo $name . " selesai diunduh!\n";
    }

    curl_multi_close($mh);

    $end = microtime(true);
    echo "Total waktu multi-threading: " . round($end - $start, 3) . " detik\n";
}

else {

    echo "=== MODE SINGLE THREAD ===\n";

    $start = microtime(true);

    foreach ($downloads as $d) {
        echo $d->fileName . " mulai diunduh...\n";
        sleep($d->delay);
        echo $d->fileName . " selesai diunduh!\n";
    }

    $end = microtime(true);
    echo "Total waktu single-thread: " . round($end - $start, 3) . " detik\n";
}

?>
