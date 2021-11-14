<?php

namespace Fratily\PathParser\Segments;

interface SegmentInterface
{
    public static function new(string $plainSegment): SegmentInterface|null;
}
