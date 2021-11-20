<?php

namespace Fratily\Tests\PathParser\Segments;

use Fratily\PathParser\Segments\PlainSegment;
use PHPUnit\Framework\TestCase;

class PlainSegmentTest extends TestCase
{
    /**
     * @dataProvider dataProviderNew
     */
    public function testNew(string $plainSegment): void
    {
        $result = PlainSegment::new($plainSegment);

        $this->assertInstanceOf(PlainSegment::class, $result);
    }

    public function dataProviderNew(): array
    {
        return [
            ['/'],
            ['/abc'],
        ];
    }
}
