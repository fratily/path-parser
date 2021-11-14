<?php

namespace Fratily\Tests\PathParser\Segments;

use Fratily\PathParser\Segments\TrailingSlashSegment;
use PHPUnit\Framework\TestCase;

class TrailingSlashSegmentTest extends TestCase
{
    /**
     * @dataProvider dataProviderNew
     */
    public function testNew(string $plainSegment, bool $expectInstanceToBeReturned): void
    {
        $result = TrailingSlashSegment::new($plainSegment);

        if ($expectInstanceToBeReturned) {
            $this->assertInstanceOf(TrailingSlashSegment::class, $result);
        } else {
            $this->assertNull($result);
        }
    }

    public function dataProviderNew(): array
    {
        return [
            ['/', true],
            ['/a', false],
            ['', false],
        ];
    }
}
