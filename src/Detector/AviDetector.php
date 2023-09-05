<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoMimeType;
use Selective\VideoType\VideoType;

/**
 * Detector.
 */
final class AviDetector implements VideoDetectorInterface
{
    /**
     * AVI.
     *
     * @param \SplFileObject $file The video file
     *
     * @return VideoType|null The video type
     */
    public function detect(\SplFileObject $file): ?VideoType
    {
        $bytes = (string)$file->fread(4);

        // Skip 4 bytes
        $file->fread(4);

        // Fetch AVI identified data
        $identifiedData = (string)$file->fread(3);

        return $bytes === 'RIFF' && $identifiedData === 'AVI' ? new VideoType(
            VideoFormat::AVI,
            VideoMimeType::VIDEO_AVI
        ) : null;
    }
}
