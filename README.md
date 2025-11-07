# selective/video-type

Video type detection library for PHP.

[![Latest Version on Packagist](https://img.shields.io/github/release/selective-php/video-type.svg?style=flat-square)](https://packagist.org/packages/selective/video-type)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![build](https://github.com/selective-php/video-type/workflows/build/badge.svg)](https://github.com/selective-php/video-type/actions)
[![Total Downloads](https://img.shields.io/packagist/dt/selective/video-type.svg?style=flat-square)](https://packagist.org/packages/selective/video-type/stats)


## Features

* Detection of the video type based on its header
* No dependencies
* Very fast

### Supported formats

* **AVI** (Audio Video Interleave)
* **MKV**
* **MP4**
* **MPEG-1** Part 2
* **MPEG-2** Part 2
* **OGG** OGV
* **3G2** 3GPP2
* **3GP** 3GPP
* **WEBM**
* **QuickTime**
* **RealMedia**
* **WMV** (Windows Media Video)
* **FLV** (Adobe Flash Video)
* **MXF** (Material Exchange Format)

## Requirements

* PHP 8.1 - 8.5

## Installation

```
composer require selective/video-type
```

## Usage

### Detect the video type of file

```php
use Selective\VideoType\VideoTypeDetector;
use Selective\VideoType\Provider\DefaultVideoProvider;
use SplFileObject;

$file = new SplFileObject('example.mp4');

$detector = new VideoTypeDetector();

// Add video detectors
$detector->addProvider(new DefaultVideoProvider());
$videoType = $detector->getVideoTypeFromFile($file);

// Get the video format
echo $videoType->getFormat(); // mp4

// Get the mime type
echo $videoType->getMimeType(); // video/mp4
```

### Detect the video type of in-memory object

```php
$video = new SplTempFileObject();

$video->fwrite('my file content');

$detector = new VideoTypeDetector();

// Add video detectors
$detector->addProvider(new DefaultVideoProvider());

echo $detector->getVideoTypeFromFile($file)->getFormat();
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
