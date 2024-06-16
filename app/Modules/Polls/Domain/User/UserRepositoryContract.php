<?php

declare(strict_types=1);

namespace App\Modules\Polls\Domain\User;

interface UserRepositoryContract
{
    public function add(User $user): User|false;
    public function read(string $id): ?User;
    public function list(): array;
}
