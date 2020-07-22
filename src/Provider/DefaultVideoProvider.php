<?php

namespace Selective\VideoType\Provider;

use Selective\VideoType\Detector\AviDetector;
use Selective\VideoType\Detector\FlvDetector;
use Selective\VideoType\Detector\MpegDetector;
use Selective\VideoType\Detector\Mpeg4Detector;
use Selective\VideoType\Detector\MkvDetector;
use Selective\VideoType\Detector\MxfDetector;
use Selective\VideoType\Detector\OgvDetector;
use Selective\VideoType\Detector\QuickTimeDetector;
use Selective\VideoType\Detector\ThreeGp2Detector;
use Selective\VideoType\Detector\ThreeGpDetector;
use Selective\VideoType\Detector\WebMDetector;
use Selective\VideoType\Detector\WmvDetector;
use Selective\VideoType\Detector\RealMediaDetector;

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
            new OgvDetector(),
            new WebMDetector(),
            new ThreeGpDetector(),
            new ThreeGp2Detector(),
            new QuickTimeDetector(),
            new WmvDetector(),
            new FlvDetector(),
            new MxfDetector(),
            new RealMediaDetector(),
        ];
    }
}
