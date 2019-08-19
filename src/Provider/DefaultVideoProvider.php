<?php

namespace Selective\VideoType\Provider;

use Selective\VideoType\Detector\AviDetector;
use Selective\VideoType\Detector\MpegDetector;

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
        ];
    }
}
