<?php

namespace Fratily\Tests\PathParser\Segments\NamedSegment;

use Fratily\PathParser\Segments\NamedSegment\ColonNamedSegment;
use PHPUnit\Framework\TestCase;

class ColonNamedSegmentTest extends TestCase
{
    /**
     * @dataProvider dataProviderNew
     */
    public function testNew(string $plainSegment, ?string $name, ?string $option): void
    {
        $result = ColonNamedSegment::new($plainSegment);

        if ($name === null) {
            $this->assertNull($result);
        } else {
            $this->assertInstanceOf(ColonNamedSegment::class, $result);
            $this->assertSame($name, $result->getName());
            $this->assertSame($option, $result->getOption());
        }
    }

    public function dataProviderNew(): array
    {
        return [
            ['/:abc', 'abc', null],
            ['/:abc(def)', 'abc', 'def'],
            ['/:abc(', null, null],
            ['/:abc(def', null, 'def'],
            ['/', null, null],
            ['/abc', null, null],
        ];
    }
}
