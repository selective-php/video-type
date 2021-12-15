<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoMimeType;
use Selective\VideoType\VideoType;
use SplFileObject;

/**
 * Detector.
 */
final class MxfDetector implements VideoDetectorInterface
{
    /**
     * MXF - Material Exchange Format.
     *
     * http://fileformats.archiveteam.org/wiki/MXF#Identifiers
     *
     * @param SplFileObject $file The video file
     *
     * @return VideoType|null The video type
     */
    public function detect(SplFileObject $file): ?VideoType
    {
        // Search at the end of the file
        $offset = $file->getSize() - 1024;
        $file->fseek($offset);

        $magicBytes = (string)hex2bin('060e2b34020501010d0102');
        $hasMagicBytes = strpos((string)$file->fread(1024), $magicBytes) !== false;

        return $hasMagicBytes ? new VideoType(
            VideoFormat::MXF,
            VideoMimeType::VIDEO_MXF
        ) : null;
    }
}
