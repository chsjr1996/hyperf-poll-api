<?php

declare(strict_types=1);

namespace App\Modules\Polls\Domain\Question;

interface QuestionRepositoryContract
{
    public function add(Question $question): Question|false;
    public function read(string $id): ?Question;
    public function list(): array;

    public function addOption(QuestionOption $questionOption): QuestionOption|false;
    public function listOptions(string $questionId): array;
    public function readOption(string $questionId, string $optionId): ?QuestionOption;

    public function addAnswer(QuestionAnswer $questionAnswer): QuestionAnswer|false;
    public function listAnswers(string $questionId): array;
}
