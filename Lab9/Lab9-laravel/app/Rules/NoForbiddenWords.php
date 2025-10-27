<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoForbiddenWords implements Rule
{
    private $foundWord;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $forbidden = ['test', 'spam', 'xxx', 'fuck', 'shit', 'damn']; // Danh sách từ cấm
        $lower = mb_strtolower((string)$value, 'UTF-8');
        
        foreach ($forbidden as $word) {
            if (str_contains($lower, $word)) {
                $this->foundWord = $word;
                return false;
            }
        }
        
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Trường :attribute chứa từ không được phép: "' . $this->foundWord . '".';
    }
}
