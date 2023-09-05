<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoMimeType;
use Selective\VideoType\VideoType;

/**
 * Detector.
 */
final class ThreeGpDetector implements VideoDetectorInterface
{
    /**
     * 3GP - The Mobile Broadband Standard.
     *
     * - https://en.wikipedia.org/wiki/3GP_and_3G2
     * - https://www.3gpp.org/
     * - https://portal.3gpp.org/desktopmodules/Specifications/SpecificationDetails.aspx?specificationId=1441
     * - https://tools.ietf.org/html/rfc3839
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
        $is3gpBrand = $brand === '3gp';

        return $box === 'ftyp' && $is3gpBrand === true ? new VideoType(
            VideoFormat::THREEGP,
            VideoMimeType::VIDEO_3GP
        ) : null;
    }
}
