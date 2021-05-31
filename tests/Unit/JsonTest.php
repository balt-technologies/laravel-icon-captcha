<?php

namespace Balt\LaravelIconCaptcha\Tests\Unit;

use Balt\LaravelIconCaptcha\Services\JsonService;
use Balt\LaravelIconCaptcha\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class JsonTest extends TestCase
{

    public function testAlwaysTrue(): void
    {
        self::assertTrue(true);
    }

    public function testRandomElementFunction(): void
    {
        $jsonService = app(JsonService::class);

        $testArray = ['1', '2', '3', '4', '5', '6', '7', '8', '9', 10];
        $randomElementsArray = [];

        for ($i = 0, $iMax = count($testArray); $i <= $iMax; $i++) {
            //Get two random elements
            $fre = $jsonService->getRandomElement($testArray);
            $sre = $jsonService->getRandomElement($testArray);
            $randomElementsArray[] = $fre;
            //Compare if they are really "random"
            if ($fre !== $sre) {
                self::assertNotEquals($fre, $sre);
            } else {
                self::assertEquals($fre, $sre);
            }
        }

        self::assertNotEquals($testArray, $randomElementsArray);
    }

    // Testen ob die decodeJson Funktion ein befülltest Array zurück gibt
    // und die question und answer unterschiedlich sind
    public function testJsonDecoder() : void
    {
        $jsonService = app(JsonService::class);

        $questions = $jsonService->decodeJson('question.json');
        $answers = $jsonService->decodeJson('answer.json');

        self::assertNotEmpty($questions);
        self::assertNotEmpty($answers);
        self::assertIsArray($questions);
        self::assertIsArray($answers);

        self::assertNotEquals($questions, $answers);
    }
}
