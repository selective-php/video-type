<?php

namespace Selective\VideoType\Provider;

use Selective\VideoType\Detector\AviDetector;

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
        ];
    }
}
