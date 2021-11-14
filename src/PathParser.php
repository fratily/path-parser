<?php

namespace Fratily\PathParser;

use Fratily\PathParser\Segments\SegmentInterface;
use InvalidArgumentException;

class PathParser
{
    /**
     * @param string $path
     * @param string[] $segmentClassNames
     * @return SegmentInterface[]
     *
     * @phpstan-template T
     * @phpstan-param class-string<T>[] $segmentClassNames
     * @phpstan-return T[]
     */
    public static function parse(string $path, array $segmentClassNames): array
    {
        /**
         * [
         *   'segment_string' => [
         *     'segment_class_name' => bool
         *   ]
         * ]
         * @var array
         * @phpstan-var array<string,array<class-string<T>,bool>>
         */
        static $cache = [];

        if ($path === '') {
            throw new InvalidArgumentException('The path must not be an empty string.');
        }

        if (trim($path) !== $path) {
            throw new InvalidArgumentException('The path must not start or end with a space');
        }

        if (!str_starts_with($path, '/')) {
            throw new InvalidArgumentException('The path must start with a slash.');
        }

        foreach ($segmentClassNames as $segmentClassName) {
            if (
                !is_string($segmentClassName)
                || !class_exists($segmentClassName)
                || !is_subclass_of($segmentClassName, SegmentInterface::class)
            ) {
                throw new InvalidArgumentException(
                    'The list of matching segments must be a list of the names of the classes that implement SegmentInterface.'
                );
            }
        }

        /**
         * @var SegmentInterface[]
         * @phpstan-var T[]
         */
        return array_map(function(string $plainSegment) use ($segmentClassNames): SegmentInterface {
            foreach ($segmentClassNames as $segmentClassName) {
                if (($segment = $segmentClassName::new($plainSegment)) !== null) {
                    return $segment;
                }
            }

            throw new PathParserException();
        }, self::splitSegments($path));
    }

    /**
     * @return string[]
     */
    private static function splitSegments(string $path): array
    {
        if (!str_starts_with($path, '/')) {
            throw new InvalidArgumentException();
        }

        return array_map(fn($v) => "/{$v}", explode('/', substr($path, 1)));
    }
}
