<?php

namespace Balt\LaravelIconCaptcha\Tests\Feature;

use Balt\LaravelIconCaptcha\Services\IconCaptchaService;
use Balt\LaravelIconCaptcha\Tests\TestCase;

class IconCaptchaTest extends TestCase
{

    public function testAlwaysTrue(): void
    {
        self::assertTrue(true);
    }

    public function testGenerateCaptchaSettings()
    {
        $iconCaptchaService = app(IconCaptchaService::class);

        $settings = $iconCaptchaService->generateCaptchaSettings();

        self::assertNotNull($settings);
    }
}
