<?php
require_once("../class.naturalthreading.php");

function doStuff($arg) {
	// print count & argument after every 1 second.
	for($i = 0; $i < 3; $i++) {
		// send(...) sends back the data to main thread which does the echo.
		NaturalThreading::send("Count: " . $i . "; Arg: " . $arg . "<br/>");
		sleep(1);
	}
}

$nt = new NaturalThreading();

// add the function, (optional arguments)
$nt->add("doStuff", "I am thread 1");
$nt->add("doStuff", "I am thread 2");

// execute the given
$ret = $nt->execute();
echo "Done!";

?>