<?php
require_once("../class.naturalthreading.php");

function printTable($num) {

	for($i = 1; $i <= 3; $i++) {
		NaturalThreading::send($num . " x " . $i . " = " . ($num*$i) . "\n");
		sleep(1);
	}
}

function receive($msg) {
	// this callback will get messages without flushing data or stuffing whitespace
	echo $msg;
}

$nt = new NaturalThreading();

$nt->add("printTable", 6);
$nt->add("printTable", 3);
$nt->setOutputHandler('receive');

// to show white-spaces
header("content-type: text/plain");

$ret = $nt->execute();
echo "Done!";

?>