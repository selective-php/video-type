<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoMimeType;
use Selective\VideoType\VideoType;

/**
 * Detector.
 */
final class RealMediaDetector implements VideoDetectorInterface
{
    /**
     * RealMedia.
     *
     * @param \SplFileObject $file The video file
     *
     * @return VideoType|null The video type
     */
    public function detect(\SplFileObject $file): ?VideoType
    {
        $magicNumber = (string)$file->fread(4);

        return $magicNumber === '.RMF' ? new VideoType(
            VideoFormat::REAL_MEDIA,
            VideoMimeType::VIDEO_REAL_MEDIA
        ) : null;
    }
}
