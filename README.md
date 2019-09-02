# selective/video-type

Video type detection library for PHP.

[![Latest Version on Packagist](https://img.shields.io/github/release/selective-php/video-type.svg?style=flat-square)](https://packagist.org/packages/selective/video-type)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/selective-php/video-type/master.svg?style=flat-square)](https://travis-ci.org/selective-php/video-type)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/selective-php/video-type.svg?style=flat-square)](https://scrutinizer-ci.com/g/selective-php/video-type/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/selective-php/video-type.svg?style=flat-square)](https://scrutinizer-ci.com/g/selective-php/video-type/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/selective/video-type.svg?style=flat-square)](https://packagist.org/packages/selective/video-type/stats)


## Features

* Detection of the video type based on its header
* No dependencies
* Very fast

### Supported formats

* **AVI** (Audio Video Interleave)
* **MKV**
* **MP4**
* **MPEG-2**
* **OGG** OGV
* **3G2** 3GPP2
* **3GP** 3GPP
* **WEBM**
* **QuickTime**
* **WMV** (Windows Media Video)

## Requirements

* PHP 7.2+

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

* MIT
