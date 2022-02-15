<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text', function (Blueprint $table) {
            $table->id();
            $table->integer('number_of_characters');
            $table->integer('number_of_words');
            $table->integer('number_of_sentences');
            $table->json('frequency_of_characters');
            $table->json('number_of_characters_in_percent');
            $table->integer('average_words_length');
            $table->float('average_number_of_words_in_sentence');
            $table->json('top_10_most_used_words');
            $table->json('top_10_longest_words');
            $table->json('top_10_shortest_words');
            $table->json('top_10_longest_sentences');
            $table->json('top_10_shortest_sentences');
            $table->integer('number_of_palindrome_words');
            $table->json('top_10_longest_palindromes');
            $table->boolean('is_the_whole_text_is_palindrome');
            $table->string('reversed_text');
            $table->json('reversed_words');
            $table->string('hash');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('text');
    }
}
