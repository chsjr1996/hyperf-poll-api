<?php

declare(strict_types=1);

namespace App\Modules\Polls\Application\Question\UseCases;

use App\Modules\Polls\Domain\Question\Question;
use App\Modules\Polls\Domain\Question\QuestionRepositoryContract;

class AddQuestion
{
    public function __construct(
        private QuestionRepositoryContract $questionRepository
    ) {
    }

    public function execute(array $questionData)
    {
        $question = new Question(
            title: $questionData['title'],
            description: $questionData['description'] ?? null,
            authorId: $questionData['authorId'],
        );

        return $this->questionRepository->add($question);
    }
}
