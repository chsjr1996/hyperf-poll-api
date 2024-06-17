<?php

declare(strict_types=1);

namespace App\Modules\Polls\Domain\Question;

enum QuestionTable: string
{
    case QUESTIONS = 'questions';
    case OPTIONS = 'question_options';
    case ANSWERS = 'question_answers';
}
