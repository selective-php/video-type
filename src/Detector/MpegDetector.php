<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoMimeType;
use Selective\VideoType\VideoType;
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
        $number = ord($binary);

        return $bytes === "\0\0\01" && $number >= 0xB0 && $number <= 0xBF ? new VideoType(
            VideoFormat::MPEG,
            VideoMimeType::VIDEO_MPEG
        ) : null;
    }
}
