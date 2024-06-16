<?php

declare(strict_types=1);

namespace App\Modules\Polls\Application\Question\UseCases;

use App\Modules\Polls\Domain\Question\QuestionAnswer;
use App\Modules\Polls\Domain\Question\QuestionRepositoryContract;

class AnswerQuestion
{
    public function __construct(
        private QuestionRepositoryContract $questionRepository
    ) {
    }

    public function execute(array $questionAnswerData)
    {
        $questionAnswer = new QuestionAnswer(
            questionOptionId: $questionAnswerData['questionOptionId'],
            userId: $questionAnswerData['userId'],
        );

        return $this->questionRepository->addAnswer($questionAnswer);
    }
}
