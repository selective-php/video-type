<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoType;
use Selective\VideoType\VideoMimeType;
use SplFileObject;

/**
 * Detector.
 */
final class AviDetector implements VideoDetectorInterface
{
    /**
     * AVI.
     *
     * @param SplFileObject $file The video file
     *
     * @return VideoType|null The video type
     */
    public function detect(SplFileObject $file): ?VideoType
    {
        $bytes = (string)$file->fread(4);

        return $bytes === 'RIFF' ? new VideoType(VideoFormat::AVI, VideoMimeType::VIDEO_AVI) : null;
    }
}
