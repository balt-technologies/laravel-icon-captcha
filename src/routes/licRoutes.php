<?php

use Balt\LaravelIconCaptcha\Controller\IconCaptchaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Icon Resolver Routes
|--------------------------------------------------------------------------
|
| To load image files from a non-public folder, you need to fetch these images.
|
*/

Route::get('generate/captcha', [IconCaptchaController::class, 'generateCaptcha'])->middleware('web');
