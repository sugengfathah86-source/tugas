<?php

class Downloader
{
    private $fileName;
    private $delay;

    public function __construct($fileName, $delay)
    {
        $this->fileName = $fileName;
        $this->delay = $delay;
    }

    public function run()
    {
        echo "{$this->fileName} mulai diunduh...\n";
        sleep($this->delay);
        echo "{$this->fileName} selesai diunduh!\n";
    }
}
