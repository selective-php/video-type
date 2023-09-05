<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoMimeType;
use Selective\VideoType\VideoType;

/**
 * Detector.
 */
final class FlvDetector implements VideoDetectorInterface
{
    /**
     * FLV - Adobe Flash Video.
     *
     * @param \SplFileObject $file The video file
     *
     * @return VideoType|null The video type
     */
    public function detect(\SplFileObject $file): ?VideoType
    {
        return (string)$file->fread(3) === 'FLV' ? new VideoType(
            VideoFormat::FLV,
            VideoMimeType::VIDEO_FLV
        ) : null;
    }
}
