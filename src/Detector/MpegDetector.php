<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoType;
use Selective\VideoType\VideoMimeType;
use SplFileObject;

/**
 * Detector.
 */
final class MpegDetector implements VideoDetectorInterface
{
    /**
     * MPEG.
     *
     * @param SplFileObject $file The video file
     *
     * @return VideoType|null The video type
     */
    public function detect(SplFileObject $file): ?VideoType
    {
        $bytes = (string)$file->fread(3);
        $binary = (string)$file->fread(1);
        $number = hexdec(bin2hex($binary));

        return $bytes === "\0\0\01" && $number >= 0xb0 && $number <= 0xbf ? new VideoType(VideoFormat::MPEG, VideoMimeType::VIDEO_MPEG) : null;
    }
}
