<?php

namespace Fratily\Tests\PathParser\PathParser;

use Fratily\PathParser\PathParser;
use Fratily\PathParser\Segments\AnySegment;
use Fratily\PathParser\Segments\SegmentInterface;
use Fratily\PathParser\Segments\TrailingSlashSegment;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

class SplitSegmentsTest extends TestCase
{
    /**
     * @dataProvider dataProviderSplitSegments
     */
    public function testSplitSegments(string $path, array $expected): void
    {
        $reflection = new ReflectionMethod(PathParser::class, 'splitSegments');
        $reflection->setAccessible(true);
        $actual = $reflection->invoke(null, $path);

        $this->assertSame($expected, $actual);
    }

    public function dataProviderSplitSegments(): array
    {
        return [
            ['/', ['/']],
            ['/abc', ['/abc']],
            ['/abc/', ['/abc', '/']],
            ['/abc/def', ['/abc', '/def']],
            ['/abc/def/', ['/abc', '/def', '/']],
        ];
    }

}
