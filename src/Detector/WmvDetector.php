<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoType;
use Selective\VideoType\VideoMimeType;
use SplFileObject;

/**
 * Detector.
 */
final class WmvDetector implements VideoDetectorInterface
{
    /**
     * WMV Windows Media Video.
     *
     * @param SplFileObject $file The video file
     *
     * @return VideoType|null The video type
     */
    public function detect(SplFileObject $file): ?VideoType
    {
        $binary = (string)$file->fread(10);
        $identifier = hex2bin('3026B2758E66CF11A6D9');

        return $binary === $identifier ? new VideoType(
            VideoFormat::WMV,
            VideoMimeType::VIDEO_WMV
        ) : null;
    }
}
