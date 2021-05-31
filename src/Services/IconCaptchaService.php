<?php

namespace Balt\LaravelIconCaptcha\Services;

use Illuminate\Support\Str;

class IconCaptchaService
{
    private JsonService $jsonService;

    public function __construct()
    {
        $this->jsonService = new JsonService();
    }

    public function generateCaptchaSettings()
    {
        //Fragen und Antwortmöglichkeiten generieren
        $question = $this->getQuestion();
        $options = $this->generateOptions($question);

        return [
            'question' => $question,
            'options' => $options
        ];
    }

    public function getQuestion()
    {
        //Question json auslesen
        $questions = $this->jsonService->decodeJson('question.json');

        //Eine zufällige Frage zurückgeben
        $randomQuestion = $this->jsonService->getRandomElement($questions);

        $randomQuestion['question'] = trans('laravel-icon-captcha::captcha.questions.' .  $randomQuestion['question']);

        return $randomQuestion;
    }

    public function generateOptions(array $question)
    {
        //Json der möglichen Antworten auslesen
        $answers = $this->jsonService->decodeJson('answer.json');

        //Eine richtige Antwort generieren
        $correctAnswer = $this->getCorrectAnswer($answers[$question['category']]);

        //Eine falsche Antwort generieren
        $wrongAnswers = $this->getWrongAnswers($answers, $question);

        //Zusammenführen der Antworten
        return $this->mergeAnswers($correctAnswer, $wrongAnswers);
    }

    public function getCorrectAnswer(array $categoryAnswer)
    {
        //Nimm ein zufälliges Element aus der Kategorie
        $correctAnswer = $this->jsonService->getRandomElement($categoryAnswer);

        //Setze die Antwort auf richtig
        $correctAnswer['id'] = Str::uuid()->toString();

        session()->put('lic_correct_answer', $correctAnswer);

        return $correctAnswer;
    }

    public function getWrongAnswers(array $answers, array $question)
    {
        $wrongAnswers = [];

        unset($answers[$question['category']]);

        for ($i = 0; $i < 3; $i ++)
        {
            //In eine zufällig andere Kategorie gehen
            $randomCategory = $this->jsonService->getRandomElement($answers);
            //Eine zufällige Antwort erhalten
            $randomAnswer = $this->jsonService->getRandomElement($randomCategory);

            $wrongAnswers[$i] = $randomAnswer;
        }

        foreach ($wrongAnswers as $key => $answer) {
            $answer['id'] = Str::uuid()->toString();
            $wrongAnswers[$key] = $answer;
        }

        return $wrongAnswers;
    }

    public function mergeAnswers(array $correctAnswer, array $wrongAnswers)
    {
        //1 richtige, 3 falsche Antworten
        $answers = [
            $correctAnswer,
        ];

        foreach ($wrongAnswers as $wrongAnswer) {
            $answers[] = $wrongAnswer;
        }

        //Durchmischen um Struktur zufällig zu gestalten
        shuffle($answers);

        return $answers;
    }
}
