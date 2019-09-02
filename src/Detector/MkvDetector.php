<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoType;
use Selective\VideoType\VideoMimeType;
use SplFileObject;

/**
 * Detector.
 */
final class MkvDetector implements VideoDetectorInterface
{
    /**
     * MKV.
     *
     * @param SplFileObject $file The video file
     *
     * @return VideoType|null The video type
     */
    public function detect(SplFileObject $file): ?VideoType
    {
        $bytes = bin2hex((string)$file->fread(4));
        $containedMatroska = strpos((string)$file->fread(46), 'matroska') !== false;

        return $bytes === '1a45dfa3' && $containedMatroska ? new VideoType(
            VideoFormat::MKV,
            VideoMimeType::VIDEO_MKV
        ) : null;
    }
}
