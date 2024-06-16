<?php

declare(strict_types=1);

namespace App\Modules\Polls\Domain\Question;

class QuestionAnswer
{
    public function __construct(
        public readonly string $questionOptionId,
        public readonly string $userId,
        public ?string $id = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null
    ) {
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setUpdatedAt(string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id ?? '',
            'question_option_id' => $this->questionOptionId,
            'user_id' => $this->userId,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }
}
