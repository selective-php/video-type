<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoType;
use Selective\VideoType\VideoMimeType;
use SplFileObject;

/**
 * Detector.
 */
final class OgvDetector implements VideoDetectorInterface
{
    /**
     * OGG.
     *
     * https://xiph.org/ogg/
     * https://tools.ietf.org/html/rfc5334
     *
     * @param SplFileObject $file The video file
     *
     * @return VideoType|null The video type
     */
    public function detect(SplFileObject $file): ?VideoType
    {
        $bytes = (string)$file->fread(4);

        if ($bytes !== 'OggS') {
            return null;
        }

        $header = (string)$file->fread(128);

        // Data served under the type "video/ogg" must contain a video codec identifier.
        // https://wiki.xiph.org/index.php/MIMETypesCodecs
        // https://tools.ietf.org/html/rfc5334#page-4
        $videoCodecs = [
            'theora' => hex2bin('807468656f7261'),
            'yuv4mpeg' => hex2bin('595556344d504547'),
            'dirac' => hex2bin('4242434400'),
            'jng' => hex2bin('8b4a4e470D0A1A0A'),
            'mng' => hex2bin('8a4d4e470D0A1A0A'),
            'png' => hex2bin('89504e470D0A1A0A'),
        ];

        foreach ($videoCodecs as $codecIdentifier) {
            if (strpos($header, (string)$codecIdentifier) === false) {
                continue;
            }

            return new VideoType(VideoFormat::OGV, VideoMimeType::VIDEO_OGG);
        }

        return null;
    }
}
