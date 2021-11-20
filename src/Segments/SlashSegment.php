<?php

namespace Fratily\PathParser\Segments;

final class SlashSegment implements SegmentInterface
{
    public static function new(string $plainSegment): SlashSegment|null
    {
        if ($plainSegment === '/') {
            return new SlashSegment();
        }

        return null;
    }
}
