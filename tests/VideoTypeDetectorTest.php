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
     * @dataProvider providerGetImageTypeFromFile
     *
     * @param string $file The file
     * @param string $format The expected format
     * @param string $mime The expected mime type
     *
     * @return void
     */
    public function testGetImageTypeFromFile(string $file, string $format, string $mime): void
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
    public function providerGetImageTypeFromFile(): array
    {
        return [
            [__DIR__ . '/videos/avi.avi', VideoFormat::AVI, VideoMimeType::VIDEO_AVI],
        ];
    }

    /**
     * Test.
     *
     * @return void
     */
    public function testGetImageTypeWithUnknownFormat(): void
    {
        $this->expectException(VideoTypeDetectorException::class);
        $this->expectExceptionMessage('Video type could not be detected');

        $imageTypeDetector = new VideoTypeDetector();

        $image = new SplTempFileObject();
        $image->fwrite('temp');

        $imageTypeDetector->getVideoTypeFromFile($image);
    }
}
