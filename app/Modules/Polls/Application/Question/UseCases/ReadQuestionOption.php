<?php

declare(strict_types=1);

namespace App\Modules\Polls\Application\Question\UseCases;

use App\Modules\Polls\Domain\Question\QuestionRepositoryContract;

class ReadQuestionOption
{
    public function __construct(
        private QuestionRepositoryContract $questionRepository
    ) {
    }

    public function execute(string $questionId, string $optionId)
    {
        return $this->questionRepository->readOption($questionId, $optionId);
    }
}
