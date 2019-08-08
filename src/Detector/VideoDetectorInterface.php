<?php

namespace Selective\VideoType\Detector;

use Selective\VideoType\VideoType;
use SplFileObject;

/**
 * Detector.
 */
interface VideoDetectorInterface
{
    /**
     * Detect.
     *
     * @param SplFileObject $file The file
     *
     * @return VideoType|null The video type
     */
    public function detect(SplFileObject $file): ?VideoType;
}
