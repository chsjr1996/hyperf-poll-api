<?php

declare(strict_types=1);

namespace App\Modules\Polls\Application\Question\UseCases;

use App\Modules\Polls\Domain\Question\QuestionRepositoryContract;

class ListQuestions
{
    public function __construct(
        private QuestionRepositoryContract $questionRepository
    ) {
    }

    public function execute()
    {
        return $this->questionRepository->list();
    }
}
