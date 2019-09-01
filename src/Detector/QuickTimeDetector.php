<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoType;
use Selective\VideoType\VideoMimeType;
use SplFileObject;

/**
 * Detector.
 */
final class QuickTimeDetector implements VideoDetectorInterface
{
    /**
     * Apple QuickTime.
     *
     * @param SplFileObject $file The video file
     *
     * @return VideoType|null The video type
     */
    public function detect(SplFileObject $file): ?VideoType
    {
        $file->fread(4);

        // Atom box format
        // http://fileformats.archiveteam.org/wiki/Boxes/atoms_format
        $box = (string)$file->fread(4);
        $brand = (string)$file->fread(2);
        $isQuickTimeBrand = $brand === 'qt';

        return $box === 'ftyp' && $isQuickTimeBrand === true ? new VideoType(
            VideoFormat::QUICK_TIME,
            VideoMimeType::VIDEO_QUICK_TIME
        ) : null;
    }
}
