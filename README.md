# NaturalThreading
# A natural multi-threading library for PHP

## Introduction

"Natural Threading" is a one-of-a-kind multi-threading class for PHP that requires absolutely no root access and works on shared servers.

It uses a clever CURL hack to simulate multi-threading, you don't need to install any additional dependencies.

## Features

- Tiny size
- Zero dependencies
- Object-oriented usage
- Does not require any root access
- Works on shared servers
- Easy to use (no class inheritance, etc)
- Can stream realtime data between threads

## Installation

Just copy the [class.naturalthreading.php](class.naturalthreading.php) into your working path, where it is easily accessible by your PHP script.

## A Simple Example

```php
<?php
require_once("class.naturalthreading.php");

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
```

You'll find plenty more to play with in the [examples](examples/) folder.

## Realtime output

Browsers do not directly allow realtime data output, so some browser hacks had to be used here.
I used SESSION for realtime thread communication and whitespace stuffing (adding spaces between messages) for realtime output.
If you want to get realtime messages without whitespace stuffing, use an [output handler](examples/callback.php).

## Parallel downloading

This project was initially started when I was writing a piece of code that scrapped thousands of URLs, and it was terribly slow. So I decided to use pthread library, but my client's shared host could not allow it. So I decided to write this tiny hack that worked on shared hosts as well, and it instantly increased the download performance by 10x! Check out the parallel  downloading [example](examples/download.php) that illustrates this.

```php
<?php
require_once("class.naturalthreading.php");

function downloadFile($url) {
	NaturalThreading::send("Started downloading: " . $url . "<br/>");

	// download and save the file as download.zip
	file_put_contents('downloaded.zip', file_get_contents($url));

	NaturalThreading::send("Download completed: " . $url . "<br/>");
}

$nt = new NaturalThreading();

// these URLs are of dummy files for speed test
$nt->add("downloadFile", "http://speedtest.wdc01.softlayer.com/downloads/test1.zip");
$nt->add("downloadFile", "http://speedtest.wdc01.softlayer.com/downloads/test1.zip");
$nt->add("downloadFile", "http://speedtest.wdc01.softlayer.com/downloads/test1.zip");
$nt->add("downloadFile", "http://speedtest.wdc01.softlayer.com/downloads/test1.zip");

echo "Downloading 4 files in parallel" . "<br/>";
$ret = $nt->execute();
echo "Done!";

?>
```

## Note

- Since this library depends on SESSION for communication, it *might* mess up with your login system. Any contribution on this issue will be appreciated.

## Contributing

Please submit bug reports, suggestions and pull requests to the [GitHub issue tracker](https://github.com/AliFlux/NaturalThreading/issues).
I would be happy if someone helps in expanding its functionality by adding more useful threading features such as joining threads and thread-pooling.

## License

This software is licenced under the [LGPL 2.1](http://www.gnu.org/licenses/lgpl-2.1.html). Please read LICENSE for information on the
software availability and distribution.
