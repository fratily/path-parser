<?php

namespace Fratily\Tests\PathParser\Segments\NamedSegment;

use Fratily\PathParser\Segments\NamedSegment\CurlyBracketNamedSegment;
use PHPUnit\Framework\TestCase;

class CurlyBracketNamedSegmentTest extends TestCase
{
    /**
     * @dataProvider dataProviderNew
     */
    public function testNew(string $plainSegment, ?string $name, ?string $option): void
    {
        $result = CurlyBracketNamedSegment::new($plainSegment);

        if ($name === null) {
            $this->assertNull($result);
        } else {
            $this->assertInstanceOf(CurlyBracketNamedSegment::class, $result);
            $this->assertSame($name, $result->getName());
            $this->assertSame($option, $result->getOption());
        }
    }

    public function dataProviderNew(): array
    {
        return [
            ['/{abc}', 'abc', null],
            ['/{abc<def>}', 'abc', 'def'],
            ['/{abc', null, null],
            ['/{abc<', null, null],
            ['/{abc<def', null, null],
            ['/{abc<def>', null, null],
            ['/', null, null],
            ['/abc', null, null],
        ];
    }
}
