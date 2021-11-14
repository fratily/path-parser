<?php

namespace Fratily\PathParser\Segments;

use InvalidArgumentException;

final class AnySegment implements SegmentInterface
{
    private string $segment;

    public static function new(string $plainSegment): AnySegment
    {
        if (!str_starts_with($plainSegment, '/')) {
            throw new InvalidArgumentException();
        }

        $obj = new AnySegment();
        $obj->segment = $plainSegment;

        return $obj;
    }

    public function getSegment(): string
    {
        return $this->segment;
    }
}
