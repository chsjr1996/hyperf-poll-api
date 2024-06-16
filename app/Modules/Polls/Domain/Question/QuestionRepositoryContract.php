<?php

declare(strict_types=1);

namespace App\Modules\Polls\Domain\Question;

interface QuestionRepositoryContract
{
    public function add(Question $question): Question|false;
    public function read(string $id): ?Question;
    public function list(): array;
}
