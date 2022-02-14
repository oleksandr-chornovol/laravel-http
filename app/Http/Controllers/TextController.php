<?php

namespace App\Http\Controllers;

use App\Models\Text;
use App\System\FileFormatter;
use App\System\TextAnalyzer;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function analyze(Request $request, TextAnalyzer $analyzer, FileFormatter $formatter)
    {
        $text = $request->file('text')->getContent();

        if (Text::where('hash', md5($text))->exist()) {
            $analyzedText = Text::where('hash', md5($text))->first();
        } else {
            $analyzedText = Text::create([
                'number_of_characters' => strlen($text),
                'number_of_words' => str_word_count($text),
                'number_of_sentences' => count($analyzer->getWords($text)),
                'frequency_of_characters' => $analyzer->frequencyOfCharacters($text),
                'number_of_characters_in_percent' => $analyzer->numberOfCharactersInPercent($text),
                'average_words_length' => $analyzer->averageWordLength($text),
                'average_number_of_words_in_sentence' => $analyzer->averageNumberOfWordsInSentence($text),
                'top_10_most_used_words' => $analyzer->top10MostUsedWords($text),
                'top_10_longest_words' => $analyzer->descSort($analyzer->getWords($text)),
                'top_10_shortest_words' => $analyzer->ascSort($analyzer->getWords($text)),
                'top_10_longest_sentences' => $analyzer->descSort($analyzer->getSentences($text)),
                'top_10_shortest_sentences' => $analyzer->ascSort($analyzer->getSentences($text)),
                'number_of_palindrome_words' => count($analyzer->getPalindromes($text)),
                'top_10_longest_palindromes' => $analyzer->descSort($analyzer->getPalindromes($text)),
                'is_the_whole_text_is_palindrome' => $analyzer->isPalindrome($text),
                'reversed_text' => strrev($text),
                'reversed_words' => implode(' ', array_reverse($analyzer->getWords($text))),
                'hash' => md5($text),
            ]);
        }

        $filePath = $formatter->generateFile($analyzedText->toArray(), $request->file_type);
        return response()->download($filePath);
    }

    public function getAverageOfStatisticalData()
    {
        return response([
            'avg_number_of_characters' => Text::avg('number_of_characters'),
            'avg_number_of_words' => Text::avg('number_of_words'),
            'avg_number_of_sentences' => Text::avg('number_of_sentences'),
            'avg_average_words_length' => Text::avg('average_words_length'),
            'avg_average_number_of_words_in_sentence' => Text::avg('average_number_of_words_in_sentence'),
        ]);
    }

    public function getNumberOfAnalyzedTexts()
    {
        return Text::all()->count();
    }
}
