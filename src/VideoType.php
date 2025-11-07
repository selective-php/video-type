<?php

namespace Selective\VideoType;

use InvalidArgumentException;

/**
 * Video type value object.
 */
final class VideoType
{
    /**
     * @var string The video format
     */
    private $format;

    /**
     * @var string The mime type
     */
    private $mime;

    /**
     * The constructor.
     *
     * @param string $format The image format
     * @param string $mime The mime type
     */
    public function __construct(string $format, string $mime)
    {
        if (empty($format)) {
            throw new InvalidArgumentException(sprintf('Invalid type: %s', $format));
        }

        if (empty($mime)) {
            throw new InvalidArgumentException(sprintf('Invalid mime type: %s', $format));
        }

        $this->format = $format;
        $this->mime = $mime;
    }

    /**
     * Get video format.
     *
     * @return string The video format
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Get mime type.
     *
     * @return string The mime type
     */
    public function getMimeType(): string
    {
        return $this->mime;
    }

    /**
     * Compare with other video type.
     *
     * @param VideoType $other The other type
     *
     * @return bool Status
     */
    public function equals(VideoType $other): bool
    {
        return $this->format === $other->format
            && $this->mime === $other->mime;
    }
}
