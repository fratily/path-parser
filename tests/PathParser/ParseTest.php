<?php

namespace Fratily\Tests\PathParser\PathParser;

use Fratily\PathParser\PathParser;
use Fratily\PathParser\Segments\PlainSegment;
use Fratily\PathParser\Segments\SegmentInterface;
use Fratily\PathParser\Segments\TrailingSlashSegment;
use PHPUnit\Framework\TestCase;

class ParseTest extends TestCase
{
    /**
     * @dataProvider dataProviderParse
     *
     * @phpstan-param array<class-string<SegmentInterface>> $segmentClassNames
     */
    public function testParse(string $path, array $segmentClassNames, array $expectedSegmentDataList): void
    {
        $actual = PathParser::parse($path, $segmentClassNames);

        $this->assertSame(count($expectedSegmentDataList), count($actual)); // @phpstan-ignore-line replace assertCount
        foreach ($expectedSegmentDataList as $index => $expectedSegmentData) {
            $this->assertInstanceOf($expectedSegmentData['class'], $actual[$index]);
            foreach ($expectedSegmentData['data'] as $getterMethod => $expected) {
                $this->assertSame($expected, $actual[$index]->$getterMethod()); // @phpstan-ignore-line variable method call
            }
        }
    }

    public function dataProviderParse(): array
    {
        return [
            [
                '/',
                [
                    TrailingSlashSegment::class,
                    PlainSegment::class,
                ],
                [
                    self::makeExpectedData(TrailingSlashSegment::class),
                ]
            ],
            [
                '/',
                [
                    PlainSegment::class,
                    TrailingSlashSegment::class,
                ],
                [
                    self::makeExpectedData(PlainSegment::class),
                ]
            ],
            [
                '/foo',
                [
                    TrailingSlashSegment::class,
                    PlainSegment::class,
                ],
                [
                    self::makeExpectedData(PlainSegment::class, ['getSegment' => '/foo']),
                ]
            ],
            [
                '/foo',
                [
                    PlainSegment::class,
                    TrailingSlashSegment::class,
                ],
                [
                    self::makeExpectedData(PlainSegment::class, ['getSegment' => '/foo']),
                ]
            ],
            [
                '/foo/',
                [
                    TrailingSlashSegment::class,
                    PlainSegment::class,
                ],
                [
                    self::makeExpectedData(PlainSegment::class, ['getSegment' => '/foo']),
                    self::makeExpectedData(TrailingSlashSegment::class),
                ]
            ],
            [
                '/foo/',
                [
                    PlainSegment::class,
                    TrailingSlashSegment::class,
                ],
                [
                    self::makeExpectedData(PlainSegment::class, ['getSegment' => '/foo']),
                    self::makeExpectedData(PlainSegment::class, ['getSegment' => '/']),
                ]
            ],
        ];
    }

    /**
     * @phpstan-param array<mixed> $data
     * @phpstan-return array<mixed>
     */
    private static function makeExpectedData(string $className, array $data = []): array
    {
        return [
            'class' => $className,
            'data' => $data,
        ];
    }
}
