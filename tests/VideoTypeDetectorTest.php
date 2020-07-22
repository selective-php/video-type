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
     * @return array[] The test data
     */
    public function providerGetVideoTypeFromFile(): array
    {
        return [
            'AVI' => [__DIR__ . '/videos/avi.avi', VideoFormat::AVI, VideoMimeType::VIDEO_AVI],
            'MPEG' => [__DIR__ . '/videos/test-mpeg1.mpeg', VideoFormat::MPEG, VideoMimeType::VIDEO_MPEG],
            'MPEG 2. file' => [__DIR__ . '/videos/test-mpeg2.mpeg', VideoFormat::MPEG, VideoMimeType::VIDEO_MPEG],
            'MP4' => [__DIR__ . '/videos/test.mp4', VideoFormat::MP4, VideoMimeType::VIDEO_MP4],
            'MKV' => [__DIR__ . '/videos/test.mkv', VideoFormat::MKV, VideoMimeType::VIDEO_MKV],
            'WEBM' => [__DIR__ . '/videos/test.webm', VideoFormat::WEBM, VideoMimeType::VIDEO_WEBM],
            'THREEG2' => [__DIR__ . '/videos/test.3g2', VideoFormat::THREEG2, VideoMimeType::VIDEO_3G2],
            'THREEGP' => [__DIR__ . '/videos/test.3gp', VideoFormat::THREEGP, VideoMimeType::VIDEO_3GP],
            'QUICK_TIME' => [__DIR__ . '/videos/test.mov', VideoFormat::QUICK_TIME, VideoMimeType::VIDEO_QUICK_TIME],
            'OGV' => [__DIR__ . '/videos/test.ogv', VideoFormat::OGV, VideoMimeType::VIDEO_OGG],
            'WMV' => [__DIR__ . '/videos/test.wmv', VideoFormat::WMV, VideoMimeType::VIDEO_WMV],
            'FLV' => [__DIR__ . '/videos/test.flv', VideoFormat::FLV, VideoMimeType::VIDEO_FLV],
            'MXF' => [__DIR__ . '/videos/test.mxf', VideoFormat::MXF, VideoMimeType::VIDEO_MXF],
            'REAL_MEDIA' => [__DIR__ . '/videos/test.rm', VideoFormat::REAL_MEDIA, VideoMimeType::VIDEO_REAL_MEDIA],
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
