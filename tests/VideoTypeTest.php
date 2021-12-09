<?php

namespace Selective\VideoType\Test;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoMimeType;
use Selective\VideoType\VideoType;

/**
 * Test.
 */
class VideoTypeTest extends TestCase
{
    /**
     * Test.
     */
    public function testCreateInstance(): void
    {
        $imageType = new VideoType(VideoFormat::AVI, VideoMimeType::VIDEO_AVI);

        $this->assertSame(VideoFormat::AVI, $imageType->getFormat());
        $this->assertSame(VideoMimeType::VIDEO_AVI, $imageType->getMimeType());
    }

    /**
     * Test.
     */
    public function testCreateInstanceWithError(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new VideoType('', '');
    }

    /**
     * Test.
     */
    public function testCreateInstanceWithError2(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new VideoType(VideoFormat::AVI, '');
    }
}
