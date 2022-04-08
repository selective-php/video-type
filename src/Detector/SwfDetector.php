<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoMimeType;
use Selective\VideoType\VideoType;
use SplFileObject;

/**
 * Detector.
 */
final class SwfDetector implements VideoDetectorInterface
{
    /**
     * SWF - Small Web Format.
     *
     * @param SplFileObject $file The video file
     *
     * @return VideoType|null The video type
     */
    public function detect(SplFileObject $file): ?VideoType
    {
        $magicNumber = (string)$file->fread(3);

        return $magicNumber === 'CWS' || $magicNumber === 'FWS' || $magicNumber === 'ZWS' ? new VideoType(
            VideoFormat::SWF,
            VideoMimeType::VIDEO_SWF
        ) : null;
    }
}
