<?php

declare(strict_types=1);

namespace App\Modules\Polls\Application\User\UseCases;

use App\Modules\Polls\Domain\User\User;
use App\Modules\Polls\Domain\User\UserRepositoryContract;

class AddUser
{
    public function __construct(
        private UserRepositoryContract $userRepository
    ) {
    }

    public function execute(array $userData)
    {
        $user = new User(
            mailAddress: $userData['mailAddress'],
            name: $userData['name'],
            password: password_hash($userData['password'], PASSWORD_DEFAULT),
        );

        return $this->userRepository->add($user);
    }
}
