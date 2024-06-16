<?php

declare(strict_types=1);

namespace App\Modules\Polls\Application\User\UseCases;

use App\Modules\Polls\Domain\User\UserRepositoryContract;

class ListUsers
{
    public function __construct(
        private UserRepositoryContract $userRepository
    ) {
    }

    public function execute()
    {
        return $this->userRepository->list();
    }
}
