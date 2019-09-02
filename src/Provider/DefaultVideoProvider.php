<?php

namespace Selective\VideoType\Provider;

use Selective\VideoType\Detector\AviDetector;
use Selective\VideoType\Detector\MpegDetector;
use Selective\VideoType\Detector\Mpeg4Detector;
use Selective\VideoType\Detector\MkvDetector;
use Selective\VideoType\Detector\QuickTimeDetector;
use Selective\VideoType\Detector\ThreeGp2Detector;
use Selective\VideoType\Detector\ThreeGpDetector;
use Selective\VideoType\Detector\WebMDetector;

/**
 * All videos formats.
 */
class DefaultVideoProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDetectors(): array
    {
        return [
            new AviDetector(),
            new MpegDetector(),
            new Mpeg4Detector(),
            new MkvDetector(),
            new WebMDetector(),
            new ThreeGpDetector(),
            new ThreeGp2Detector(),
            new QuickTimeDetector(),
        ];
    }
}
