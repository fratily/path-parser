<?php

namespace Fratily\PathParser\Segments\NamedSegment;

use Fratily\PathParser\Segments\SegmentHelper;
use Fratily\PathParser\Segments\SegmentInterface;

class ColonNamedSegment implements SegmentInterface
{
    private string $name;

    private ?string $option;

    public static function new(string $plainSegment): ColonNamedSegment|null
    {
        [$isMatched, $matches] = SegmentHelper::match($plainSegment, '/\A\/:([a-z_][a-z0-9_]*)(?:\((.+)\))?\z/i');

        if (!$isMatched) {
            return null;
        }

        $obj = new ColonNamedSegment();
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
