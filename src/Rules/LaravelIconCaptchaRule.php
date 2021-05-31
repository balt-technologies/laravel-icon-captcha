<?php

namespace Balt\LaravelIconCaptcha\Rules;

use Illuminate\Contracts\Validation\Rule;

class LaravelIconCaptchaRule implements Rule
{
    private array $captcha;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->captcha = session()->get('lic_correct_answer');
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
        return $value === $this->captcha['id'];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('laravel-icon-captcha::captcha.messages.failed');
    }
}
