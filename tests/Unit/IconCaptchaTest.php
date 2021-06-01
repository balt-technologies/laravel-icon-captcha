<?php

namespace Balt\LaravelIconCaptcha\Tests\Unit;

use Balt\LaravelIconCaptcha\Services\IconCaptchaService;
use Balt\LaravelIconCaptcha\Services\JsonService;
use Balt\LaravelIconCaptcha\Tests\TestCase;

class IconCaptchaTest extends TestCase
{
    public function testGetQuestion(): array
    {
        $iconCaptchaService = app(IconCaptchaService::class);

        $question = $iconCaptchaService->getQuestion();

        self::assertNotNull($iconCaptchaService);

        return $question;
    }

    public function testGetCorrectAnswer()
    {
        $iconCaptchaService = app(IconCaptchaService::class);
        $jsonService = app(JsonService::class);

        //Json der möglichen Antworten auslesen
        $answers = $jsonService->decodeJson('answer.json');

        $question = $this->testGetQuestion();

        $correctAnswer = $iconCaptchaService->getCorrectAnswer($answers[$question['category']]);

        //Testen ob die correct answer ordnungsgemäß in die Session übergeben wurde
        self::assertEquals($correctAnswer, session()->get('lic_correct_answer'));

        return $correctAnswer;
    }

    public function testGetWrongAnswers()
    {
        $iconCaptchaService = app(IconCaptchaService::class);
        $jsonService = app(JsonService::class);

        //Json der möglichen Antworten auslesen
        $answers = $jsonService->decodeJson('answer.json');

        $question = $this->testGetQuestion();

        $correctAnswer = $this->testGetCorrectAnswer();

        $wrongAnswers = $iconCaptchaService->getWrongAnswers($answers, $question);

        foreach ($wrongAnswers as $wrongAnswer)
        {
            //Prüfen, ob alle wrongAnswers ungleich der richtigen Antwort ist
            self::assertNotEquals($wrongAnswer,$correctAnswer);
        }

        return $wrongAnswers;
    }

    public function testMergeAnswers()
    {
        $iconCaptchaService = app(IconCaptchaService::class);

        $ca = $this->testGetCorrectAnswer();
        $wa = $this->testGetWrongAnswers();

        $mergedAnswers = $iconCaptchaService->mergeAnswers($ca, $wa);

        $mergedCount = count([$ca]) + count($wa);

        self::assertCount($mergedCount, $mergedAnswers);
    }
}
