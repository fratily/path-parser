<?php

namespace Fratily\PathParser\Segments;

final class TrailingSlashSegment implements SegmentInterface
{
    public static function new(string $plainSegment): TrailingSlashSegment|null
    {
        if ($plainSegment === '/') {
            return new TrailingSlashSegment();
        }

        return null;
    }
}
