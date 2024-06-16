<?php

declare(strict_types=1);

namespace App\Modules\Polls\Domain\User;

class User
{
    public function __construct(
        public readonly string $mailAddress,
        public readonly string $name,
        public readonly ?string $password = null,
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
            'mail_address' => $this->mailAddress,
            'name' => $this->name,
            'password' => $this->password,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }
}
