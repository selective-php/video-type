<?php

namespace Selective\VideoType\Test;

use PHPUnit\Framework\TestCase;
use Selective\VideoType\VideoFormat;
use Selective\VideoType\VideoType;
use Selective\VideoType\VideoTypeDetector;
use Selective\VideoType\Exception\VideoTypeDetectorException;
use Selective\VideoType\VideoMimeType;
use Selective\VideoType\Provider\DefaultVideoProvider;
use SplFileObject;
use SplTempFileObject;

/**
 * Test.
 */
class VideoTypeDetectorTest extends TestCase
{
    /**
     * Create instance.
     *
     * @return VideoTypeDetector The detector
     */
    private function createDetector(): VideoTypeDetector
    {
        $detector = new VideoTypeDetector();

        $detector->addProvider(new DefaultVideoProvider());

        return $detector;
    }

    /**
     * Test.
     *
     * @dataProvider providerGetVideoTypeFromFile
     *
     * @param string $file The file
     * @param string $format The expected format
     * @param string $mime The expected mime type
     *
     * @return void
     */
    public function testGetVideoTypeFromFile(string $file, string $format, string $mime): void
    {
        $this->assertFileExists($file);

        $detector = $this->createDetector();
        $file = new SplFileObject($file);
        $actual = $detector->getVideoTypeFromFile($file);

        $this->assertSame($format, $actual->getFormat());
        $this->assertSame($mime, $actual->getMimeType());
        $this->assertTrue($actual->equals(new VideoType($format, $mime)));
    }

    /**
     * Provider.
     *
     * @return array
     */
    public function providerGetVideoTypeFromFile(): array
    {
        return [
            [__DIR__ . '/videos/avi.avi', VideoFormat::AVI, VideoMimeType::VIDEO_AVI],
            [__DIR__ . '/videos/test-mpeg1.mpeg', VideoFormat::MPEG, VideoMimeType::VIDEO_MPEG],
            [__DIR__ . '/videos/test-mpeg2.mpeg', VideoFormat::MPEG, VideoMimeType::VIDEO_MPEG],
            [__DIR__ . '/videos/test.mp4', VideoFormat::MP4, VideoMimeType::VIDEO_MP4],
            [__DIR__ . '/videos/test.mkv', VideoFormat::MKV, VideoMimeType::VIDEO_MKV],
            [__DIR__ . '/videos/test.webm', VideoFormat::WEBM, VideoMimeType::VIDEO_WEBM],
            [__DIR__ . '/videos/test.3g2', VideoFormat::THREEG2, VideoMimeType::VIDEO_3G2],
            [__DIR__ . '/videos/test.3gp', VideoFormat::THREEGP, VideoMimeType::VIDEO_3GP],
            [__DIR__ . '/videos/test.mov', VideoFormat::QUICK_TIME, VideoMimeType::VIDEO_QUICK_TIME],
            [__DIR__ . '/videos/test.ogv', VideoFormat::OGV, VideoMimeType::VIDEO_OGG],
        ];
    }

    /**
     * Test.
     *
     * @return void
     */
    public function testGetVideoTypeWithUnknownFormat(): void
    {
        $this->expectException(VideoTypeDetectorException::class);
        $this->expectExceptionMessage('Video type could not be detected');

        $imageTypeDetector = new VideoTypeDetector();

        $image = new SplTempFileObject();
        $image->fwrite('temp');

        $imageTypeDetector->getVideoTypeFromFile($image);
    }
}
