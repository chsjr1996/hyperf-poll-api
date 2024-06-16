<?php

declare(strict_types=1);

use App\Modules\Polls\Domain\User\UserRepositoryContract;
use App\Modules\Polls\Infrastructure\User\Repository\HyperfUserRepository;

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    // Repositories
    UserRepositoryContract::class => HyperfUserRepository::class,
];
