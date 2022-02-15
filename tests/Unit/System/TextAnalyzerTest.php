<?php

namespace Tests\Unit\System;

use App\System\TextAnalyzer;
use PHPUnit\Framework\TestCase;

class TextAnalyzerTest extends TestCase
{
    /**
     * @dataProvider provideAverageWordLengthData
     */
    public function test_average_word_length($expectedResult, $input): void
    {
        self::assertSame($expectedResult, (new TextAnalyzer())->averageWordLength($input));
    }

    public function provideAverageWordLengthData(): array
    {
        return [
            [
                3,
                'It is a long established fact that a reader will be d by the readable content of a page when',
            ],
            [
                4,
                'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the',
            ],
            [
                5,
                'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks',
            ]
        ];
    }
}
