<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoMimeType;
use Selective\VideoType\VideoType;

/**
 * Detector.
 */
final class ThreeGp2Detector implements VideoDetectorInterface
{
    /**
     * 3G2 - 3GPP2.
     *
     * - https://en.wikipedia.org/wiki/3GP_and_3G2
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
        $brand = (string)$file->fread(3);
        $is3gpBrand = $brand === '3g2';

        return $box === 'ftyp' && $is3gpBrand === true ? new VideoType(
            VideoFormat::THREEG2,
            VideoMimeType::VIDEO_3G2
        ) : null;
    }
}
