<?php

namespace Selective\VideoType\Provider;

use Selective\VideoType\Detector\VideoDetectorInterface;

interface ProviderInterface
{
    /**
     * Return list of detectors.
     *
     * @return VideoDetectorInterface[] The list
     */
    public function getDetectors(): array;
}
