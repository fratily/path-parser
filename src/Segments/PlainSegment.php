<?php

namespace Fratily\PathParser\Segments;

use InvalidArgumentException;

final class PlainSegment implements SegmentInterface
{
    private string $segment;

    public static function new(string $plainSegment): PlainSegment
    {
        if (!str_starts_with($plainSegment, '/')) {
            throw new InvalidArgumentException();
        }

        $obj = new PlainSegment();
        $obj->segment = $plainSegment;

        return $obj;
    }

    public function getSegment(): string
    {
        return $this->segment;
    }
}
