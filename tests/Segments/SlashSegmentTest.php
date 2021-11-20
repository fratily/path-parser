<?php

namespace Fratily\Tests\PathParser\Segments;

use Fratily\PathParser\Segments\SlashSegment;
use PHPUnit\Framework\TestCase;

class SlashSegmentTest extends TestCase
{
    /**
     * @dataProvider dataProviderNew
     */
    public function testNew(string $plainSegment, bool $expectInstanceToBeReturned): void
    {
        $result = SlashSegment::new($plainSegment);

        if ($expectInstanceToBeReturned) {
            $this->assertInstanceOf(SlashSegment::class, $result);
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
