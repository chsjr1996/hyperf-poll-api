<?php

declare(strict_types=1);

namespace App\Modules\Polls\Domain\Question;

class Question
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly string $authorId,
        public QuestionStatus $status,
        public ?string $id = null,
        public ?string $closeAt = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null
    ) {
    }

    public function setStatus(QuestionStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setCloseAt(string $closeAt): self
    {
        $this->closeAt = $closeAt;

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
            'title' => $this->title,
            'description' => $this->description,
            'author_id' => $this->authorId,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }
}
