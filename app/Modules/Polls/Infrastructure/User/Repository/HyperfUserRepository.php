<?php

declare(strict_types=1);

namespace App\Modules\Polls\Infrastructure\User\Repository;

use App\Modules\Polls\Domain\User\User;
use App\Modules\Polls\Domain\User\UserRepositoryContract;
use App\Modules\Shared\Infrastructure\Repository\AbstractHyperfRepository;
use Hyperf\DbConnection\Db;

use function Hyperf\Support\now;

class HyperfUserRepository extends AbstractHyperfRepository implements UserRepositoryContract
{
    public const TABLE_NAME = 'users';

    public function add(User $user): User|false
    {
        try {
            Db::beginTransaction();
            $user->setCreatedAt(now()->format('Y-m-d H:i:s'));
            $user->setUpdatedAt(now()->format('Y-m-d H:i:s'));
            $userId = Db::table(self::TABLE_NAME)->insertGetId($user->toArray());
            Db::commit();

            $user->setId($userId);

            return $user;
        } catch (\Throwable $th) {
            Db::rollBack();
            $this->handleQueryException($th);

            throw $th;
        }
    }

    public function read(int $id): ?User
    {
        $user = Db::table(self::TABLE_NAME)
            ->select('*')
            ->where('id', $id)
            ->first();

        if (is_null($user)) {
            return null;
        }

        return new User(
            id: $user->id,
            mailAddress: $user->mail_address,
            name: $user->name,
            createdAt: $user->created_at,
            updatedAt: $user->updated_at,
        );
    }

    public function list(): array
    {
        return Db::table(self::TABLE_NAME)
            ->select('*')
            ->get()
            ->toArray();
    }
}
