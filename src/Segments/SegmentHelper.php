<?php

namespace Fratily\PathParser\Segments;

use LogicException;

final class SegmentHelper
{
    /**
     * @phpstan-return array{bool,array<int|string,string>}
     */
    public static function match(string $plainSegment, string $regex): array
    {
        if (($result = preg_match($regex, $plainSegment, $matches)) === false) {
            throw new LogicException();
        }

        return [$result === 1, $matches];
    }
}
