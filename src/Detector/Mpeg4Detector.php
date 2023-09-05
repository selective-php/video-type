<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoMimeType;
use Selective\VideoType\VideoType;

/**
 * Detector.
 */
final class Mpeg4Detector implements VideoDetectorInterface
{
    /**
     * MPEG-4.
     *
     * @param \SplFileObject $file The video file
     *
     * @return VideoType|null The video type
     */
    public function detect(\SplFileObject $file): ?VideoType
    {
        $file->fread(4);

        // Atom box format
        // http://fileformats.archiveteam.org/wiki/Boxes/atoms_format
        $box = (string)$file->fread(4);
        $brand = (string)$file->fread(4);

        $mp4Brands = [
            'isom' => 1,
            'iso2' => 1,
            'iso3' => 1,
            'iso4' => 1,
            'iso5' => 1,
            'iso6' => 1,
            'iso7' => 1,
            'iso8' => 1,
            'iso9' => 1,
            'mp41' => 1,
            'mp42' => 1,
        ];

        $isMp4Brand = isset($mp4Brands[$brand]);

        return $box === 'ftyp' && $isMp4Brand === true ? new VideoType(
            VideoFormat::MP4,
            VideoMimeType::VIDEO_MP4
        ) : null;
    }
}
