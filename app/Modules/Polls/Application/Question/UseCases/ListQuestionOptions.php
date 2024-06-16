<?php

declare(strict_types=1);

namespace App\Modules\Polls\Application\Question\UseCases;

use App\Modules\Polls\Domain\Question\QuestionRepositoryContract;

class ListQuestionOptions
{
    public function __construct(
        private QuestionRepositoryContract $questionRepository
    ) {
    }

    public function execute(string $questionId)
    {
        return $this->questionRepository->listOptions($questionId);
    }
}
