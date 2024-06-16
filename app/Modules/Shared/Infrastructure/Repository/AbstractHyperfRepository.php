<?php

declare(strict_types=1);

namespace App\Modules\Shared\Infrastructure\Repository;

class AbstractHyperfRepository
{
    private const DUPLICATED_ENTRY_CODE = "23000";

    /**
     * @todo create specific exceptions to each Query Exception
     * @throws \Exception
     */
    protected function handleQueryException(\Throwable $ex): void
    {
        if (get_class($ex) !== \Hyperf\Database\Exception\QueryException::class) {
            return;
        }

        if ($ex->getCode() === self::DUPLICATED_ENTRY_CODE) {
            throw new \Exception('Duplicated register.');
        }
    }
}
