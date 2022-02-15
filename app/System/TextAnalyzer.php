<?php

namespace App\System;

class TextAnalyzer {
    public function frequencyOfCharacters(string $text): array
    {
        $text = preg_replace('/\s+/', '', $text);
        $result = [];

        foreach (count_chars($text, 1) as $char => $number) {
            $result[chr($char)] = $number;
        }

        return $result;
    }

    public function numberOfCharactersInPercent(string $text): array
    {
        $text = preg_replace('/\s+/', '', $text);
        $textLen = strlen($text);
        $result = [];

        foreach (count_chars($text, 1) as $char => $number) {
            $result[chr($char)] = number_format((100.0 * $number) / $textLen, 2);
        }

        return $result;
    }

    public function averageWordLength(string $text): int
    {
        $wordsCount = $wordsLength = 0;

        $words = preg_split('/\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);
        foreach ($words as $word) {
            $wordsCount++;
            $wordsLength += strlen($word);
        }

        return intdiv($wordsLength, $wordsCount);
    }

    public function averageNumberOfWordsInSentence($text): float
    {
        $sentences = preg_split('/(?<=[.?!;:])\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);
        $numberOfWords = 0;

        if (is_array($sentences)) {
            foreach ($sentences as $key => $sentence) {
                $numberOfWords += str_word_count($sentence);
            }
        }

        return round($numberOfWords / count($sentences));
    }

    public function top10MostUsedWords(string $text): array
    {
        $words = array_count_values($this->getWords($text));
        arsort($words);
        return array_slice(array_keys($words), 0, 10, true);
    }

    public function getWords(string $text): array
    {
        return array_unique(preg_split("/\s+/", $text));
    }

    public function getSentences(string $text): array
    {
        return array_unique(preg_split('/(?<=[.?!;:])\s+/', $text, -1, PREG_SPLIT_NO_EMPTY));
    }

    public function descSort(array $array): array
    {
        usort($array, function ($a, $b) {
            return strlen($b) <=> strlen($a);
        });

        return array_slice($array, 0, 10);
    }

    public function ascSort(array $array): array
    {
        usort($array, function ($a, $b) {
            return strlen($a) <=> strlen($b);
        });

        return array_slice($array, 0, 10);
    }

    public function getPalindromes(string $text): array
    {
        $palindromes = [];
        foreach ($this->getWords($text) as $word) {
            if ($this->isPalindrome($word)) {
                $palindromes[] = $word;
            }
        }

        return array_unique($palindromes);
    }

    public function isPalindrome(string $text): bool
    {
        for ($i = 0, $j = strlen($text) - 1; $j > $i; $i++, $j--) {
            if ($text[$i] != $text[$j]) {
                return false;
            }
        }

        return true;
    }
}
