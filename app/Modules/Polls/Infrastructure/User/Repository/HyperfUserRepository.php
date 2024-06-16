<?php

declare(strict_types=1);

namespace App\Modules\Polls\Infrastructure\User\Repository;

use App\Modules\Polls\Domain\User\User;
use App\Modules\Polls\Domain\User\UserRepositoryContract;
use App\Modules\Shared\Infrastructure\Repository\AbstractHyperfRepository;
use Hyperf\DbConnection\Db;
use Ramsey\Uuid\Uuid;

use function Hyperf\Support\now;

class HyperfUserRepository extends AbstractHyperfRepository implements UserRepositoryContract
{
    public const TABLE_NAME = 'users';

    public function add(User $user): User|false
    {
        try {
            Db::beginTransaction();

            $user->setId(Uuid::uuid4()->toString());
            $user->setCreatedAt(now()->format('Y-m-d H:i:s'));
            $user->setUpdatedAt(now()->format('Y-m-d H:i:s'));

            if (!Db::table(self::TABLE_NAME)->insert($user->toArray())) {
                throw new \Exception('Error on add user.');
            }

            Db::commit();

            return $user;
        } catch (\Throwable $th) {
            Db::rollBack();
            $this->handleQueryException($th);

            throw $th;
        }
    }

    public function read(string $id): ?User
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
