<?php
require_once("../class.naturalthreading.php");

function downloadFile($url) {
	NaturalThreading::send("Started downloading: " . $url . "<br/>");

	file_put_contents('downloaded.zip', file_get_contents($url));

	NaturalThreading::send("Download completed: " . $url . "<br/>");
}

$nt = new NaturalThreading();

$nt->add("downloadFile", "http://speedtest.wdc01.softlayer.com/downloads/test1.zip");
$nt->add("downloadFile", "http://speedtest.wdc01.softlayer.com/downloads/test1.zip");
$nt->add("downloadFile", "http://speedtest.wdc01.softlayer.com/downloads/test1.zip");
$nt->add("downloadFile", "http://speedtest.wdc01.softlayer.com/downloads/test1.zip");

echo "Downloading 4 files in parallel." . "<br/>";
$ret = $nt->execute();
echo "Done!";

?>