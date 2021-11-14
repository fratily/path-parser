<?php

namespace Fratily\Tests\PathParser\Segments;

use Fratily\PathParser\Segments\AnySegment;
use PHPUnit\Framework\TestCase;

class AnySegmentTest extends TestCase
{
    /**
     * @dataProvider dataProviderNew
     */
    public function testNew(string $plainSegment): void
    {
        $result = AnySegment::new($plainSegment);

        $this->assertInstanceOf(AnySegment::class, $result);
    }

    public function dataProviderNew(): array
    {
        return [
            ['/'],
            ['/abc'],
        ];
    }
}
