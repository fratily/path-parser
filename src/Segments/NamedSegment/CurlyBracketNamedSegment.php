<?php

namespace Fratily\PathParser\Segments\NamedSegment;

use Fratily\PathParser\Segments\SegmentHelper;
use Fratily\PathParser\Segments\SegmentInterface;

class CurlyBracketNamedSegment implements SegmentInterface
{
    private string $name;

    private ?string $option;

    public static function new(string $plainSegment): CurlyBracketNamedSegment|null
    {
        [$isMatched, $matches] = SegmentHelper::match($plainSegment, '/\A\/{([a-z_][a-z0-9_]*)(?:<(.+)>)?}\z/i');

        if (!$isMatched) {
            return null;
        }

        $obj = new CurlyBracketNamedSegment();
        $obj->name = $matches[1];
        $obj->option = $matches[2] ?? null;
        return $obj;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOption(): ?string
    {
        return $this->option;
    }
}
