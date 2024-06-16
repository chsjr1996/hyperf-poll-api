<?php

declare(strict_types=1);

namespace App\Modules\Polls\Application\Question\UseCases;

use App\Modules\Polls\Domain\Question\QuestionOption;
use App\Modules\Polls\Domain\Question\QuestionRepositoryContract;

class AddOptionOnQuestion
{
    public function __construct(
        private QuestionRepositoryContract $questionRepository
    ) {
    }

    public function execute(string $questionId, array $questionOptionData)
    {
        $questionOption = new QuestionOption(
            questionId: $questionId,
            title: $questionOptionData['title'],
        );

        return $this->questionRepository->addOption($questionOption);
    }
}
