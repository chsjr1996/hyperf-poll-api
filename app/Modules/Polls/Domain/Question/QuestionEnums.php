<?php

declare(strict_types=1);

namespace App\Modules\Polls\Domain\Question;

enum QuestionEnums: string
{
    case TABLE_QUESTIONS = 'questions';
    case TABLE_OPTIONS = 'question_options';
    case TABLE_ANSWERS = 'question_answers';
}
