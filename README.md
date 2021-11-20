# Fratily Path Parser

`fratily/path-parser` is parser of url pathname.

## Install

``` bash
$ composer require fratily/path-parser
```

## Usage

```php
$segments = \Fratily\PathParser\PathParser::parse('/foo/:id/bar/', [
    \Fratily\PathParser\Segments\SlashSegment::class,
    CustomSegment::class,
    \Fratily\PathParser\Segments\PlainSegment::class,
]);

var_dump(
    // /foo
    get_class($segments[0]), // "Fratily\PathParser\Segments\PlainSegment"
    $segments[0]->getSegment(), // "/foo"
    // /:id
    get_class($segments[1]), // "CustomSegment"
    $segments[0]->getName(), // "/id"
    // /bar
    get_class($segments[2]), // "Fratily\PathParser\Segments\PlainSegment"
    $segments[0]->getSegment(), // "/bar"
    // /
    get_class($segments[3]), // "Fratily\PathParser\Segments\SlashSegment"
);


class CustomSegment implements \Fratily\PathParser\Segments\SegmentInterface
{
    private string $name;

    public static function new(string $plainSegment): CustomSegment|null
    {
        if (1 !== preg_match('/\A:([a-z]+)\z/i', $plainSegment, $m)) {
            return null;
        }

        $obj = new CustomSegment();
        $obj->name = $m[1];
        return $obj;
    }

    public static function getName(): string
    {
        return $this->name;
    }
}
```
