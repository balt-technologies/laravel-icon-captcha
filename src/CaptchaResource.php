<?php

namespace Balt\LaravelIconCaptcha;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CaptchaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $captchaSettings = $this->resource;

        return [
            'question' => $captchaSettings['question']['question'],
            'options' => $captchaSettings['options'],
        ];
    }
}
