<?php

namespace Balt\LaravelIconCaptcha\Services;

use Illuminate\Support\Facades\File;

class JsonService
{
    public function getRandomElement(array $array)
    {
        $random = array_rand($array);

        return $array[$random];
    }

    public function decodeJson(string $fileName)
    {
        $path = dirname(__FILE__, 2) . '/assets/json/' . $fileName;

        $file = File::get($path);
        return json_decode($file, true);
    }
}
