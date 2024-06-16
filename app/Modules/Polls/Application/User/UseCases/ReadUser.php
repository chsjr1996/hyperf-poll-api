<?php

declare(strict_types=1);

namespace App\Modules\Polls\Application\User\UseCases;

use App\Modules\Polls\Domain\User\UserRepositoryContract;

class ReadUser
{
    public function __construct(
        private UserRepositoryContract $userRepository
    ) {
    }

    public function execute(string $id)
    {
        return $this->userRepository->read($id);
    }
}
