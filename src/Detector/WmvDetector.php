<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoType;
use Selective\VideoType\VideoMimeType;
use SplFileObject;

/**
 * Detector.
 */
final class WmvDetector implements VideoDetectorInterface
{
    /**
     * WMV Windows Media Video.
     *
     * https://en.wikipedia.org/wiki/Windows_Media_Video
     * https://en.wikipedia.org/wiki/Advanced_Systems_Format
     * https://stackoverflow.com/q/9910313/1461181
     * http://avifile.sourceforge.net/docs.htm
     * https://toolslick.com/conversion/data/guid
     *
     *
     * @param SplFileObject $file The video file
     *
     * @return VideoType|null The video type
     */
    public function detect(SplFileObject $file): ?VideoType
    {
        $binary = (string)$file->fread(16);

        // https://www.loc.gov/preservation/digital/formats/fdd/fdd000027.shtml#identification
        // https://www.garykessler.net/library/file_sigs.html
        $identifier = hex2bin('3026B2758E66CF11A6D900AA0062CE6C');
        if ($binary !== $identifier) {
            return null;
        }

        $header = (string)$file->fread(8192);

        // The ASF video stream GUID must be present.
        // ASF_Video_Media: BC19EFC0-5B4D-11CF-A8FD-00805F5C442B
        // https://www.sno.phy.queensu.ca/~phil/exiftool/TagNames/ASF.html
        $asfVideoMedia = (string)hex2bin('c0ef19bc4d5bcf11a8fd00805f5c442b');

        return strpos($header, $asfVideoMedia) !== false ? new VideoType(
            VideoFormat::WMV,
            VideoMimeType::VIDEO_WMV
        ) : null;
    }
}
