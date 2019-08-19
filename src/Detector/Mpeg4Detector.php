<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoType;
use Selective\VideoType\VideoMimeType;
use SplFileObject;

/**
 * Detector.
 */
final class Mpeg4Detector implements VideoDetectorInterface
{
    /**
     * MPEG-4.
     *
     * @param SplFileObject $file The video file
     *
     * @return VideoType|null The video type
     */
    public function detect(SplFileObject $file): ?VideoType
    {
        $file->fread(4);
        $bytes = (string)$file->fread(4);

        return $bytes === "ftyp" ? new VideoType(VideoFormat::MP4, VideoMimeType::VIDEO_MP4) : null;
    }
}
