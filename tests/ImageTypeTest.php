<?php

namespace Selective\VideoType\Test;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoType;
use Selective\VideoType\VideoMimeType;

/**
 * Test.
 */
class ImageTypeTest extends TestCase
{
    /**
     * Test.
     *
     * @return void
     */
    public function testCreateInstance(): void
    {
        $imageType = new VideoType(VideoFormat::AVI, VideoMimeType::VIDEO_AVI);

        $this->assertSame(VideoFormat::AVI, $imageType->getFormat());
        $this->assertSame(VideoMimeType::VIDEO_AVI, $imageType->getMimeType());
    }

    /**
     * Test.
     *
     * @return void
     */
    public function testCreateInstanceWithError(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new VideoType('', '');
    }

    /**
     * Test.
     *
     * @return void
     */
    public function testCreateInstanceWithError2(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new VideoType(VideoFormat::AVI, '');
    }
}
