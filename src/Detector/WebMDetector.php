<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoType;
use Selective\VideoType\VideoMimeType;
use SplFileObject;

/**
 * Detector.
 */
final class WebMDetector implements VideoDetectorInterface
{
    /**
     * WebM.
     *
     * @param SplFileObject $file The video file
     *
     * @return VideoType|null The video type
     */
    public function detect(SplFileObject $file): ?VideoType
    {
        $bytes = bin2hex((string)$file->fread(4));
        $containedWebM = strpos((string)$file->fread(40), "webm");

        return $bytes === "1a45dfa3" && $containedWebM ? new VideoType(VideoFormat::WEBM, VideoMimeType::VIDEO_WEBM) : null;
    }
}
