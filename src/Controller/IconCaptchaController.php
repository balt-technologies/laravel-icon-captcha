<?php

namespace Balt\LaravelIconCaptcha\Controller;

use Balt\LaravelIconCaptcha\CaptchaResource;
use Balt\LaravelIconCaptcha\Services\IconCaptchaService;
use Illuminate\Http\Request;

class IconCaptchaController
{
    protected IconCaptchaService $iconCaptchaService;

    public function __construct(IconCaptchaService $iconCaptchaService)
    {
        $this->iconCaptchaService = $iconCaptchaService;
    }

    /**
     * @param Request $request
     * @return CaptchaResource
     */
    public function generateCaptcha(Request $request): CaptchaResource
    {
        $captchaSettings = $this->iconCaptchaService->generateCaptchaSettings();

        return new CaptchaResource($captchaSettings);
    }
}
