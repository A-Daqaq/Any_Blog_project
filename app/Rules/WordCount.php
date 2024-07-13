<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class WordCount implements ValidationRule
{
    /**
      protected $min;
     protected $max;
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
    }

    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function passes($attribute, $value)
    {
        $wordCount = str_word_count($value);
        return $wordCount >= $this->min && $wordCount <= $this->max;
    }

    public function message()
    {
        return "The :attribute must be between {$this->min} and {$this->max} words.";
    }
}
