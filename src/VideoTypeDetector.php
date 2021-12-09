<?php

namespace Selective\VideoType;

use Selective\VideoType\Detector\VideoDetectorInterface;
use Selective\VideoType\Exception\VideoTypeDetectorException;
use Selective\VideoType\Provider\ProviderInterface;
use SplFileObject;

/**
 * Video type detection.
 */
final class VideoTypeDetector
{
    /**
     * @var VideoDetectorInterface[]
     */
    private $detectors = [];

    /**
     * Add detector.
     *
     * @param VideoDetectorInterface $detector The detector
     */
    public function addDetector(VideoDetectorInterface $detector): void
    {
        $this->detectors[] = $detector;
    }

    /**
     * Add provider.
     *
     * @param ProviderInterface $provider The provider
     */
    public function addProvider(ProviderInterface $provider): void
    {
        foreach ($provider->getDetectors() as $detector) {
            $this->addDetector($detector);
        }
    }

    /**
     * Detect video type.
     *
     * @param SplFileObject $file The video file
     *
     * @throws VideoTypeDetectorException
     *
     * @return VideoType The video type
     */
    public function getVideoTypeFromFile(SplFileObject $file): VideoType
    {
        $type = $this->detectFile($file);

        if ($type === null) {
            throw new VideoTypeDetectorException('Video type could not be detected');
        }

        return $type;
    }

    /**
     * Reads and returns the type of the video.
     *
     * @param SplFileObject $file The video file
     */
    private function detectFile(SplFileObject $file): ?VideoType
    {
        foreach ($this->detectors as $detector) {
            $file->rewind();

            $type = $detector->detect($file);

            if ($type !== null) {
                return $type;
            }
        }

        return null;
    }
}
