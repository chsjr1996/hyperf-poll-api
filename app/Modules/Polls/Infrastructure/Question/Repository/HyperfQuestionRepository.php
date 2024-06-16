<?php

declare(strict_types=1);

namespace App\Modules\Polls\Infrastructure\Question\Repository;

use App\Modules\Polls\Domain\Question\Question;
use App\Modules\Polls\Domain\Question\QuestionOption;
use App\Modules\Polls\Domain\Question\QuestionRepositoryContract;
use App\Modules\Shared\Infrastructure\Repository\AbstractHyperfRepository;
use Hyperf\DbConnection\Db;
use Ramsey\Uuid\Uuid;

use function Hyperf\Support\now;

class HyperfQuestionRepository extends AbstractHyperfRepository implements QuestionRepositoryContract
{
    public const TABLE_NAME = 'questions';
    public const TABLE_OPTIONS_NAME = 'question_options';

    public function add(Question $question): Question|false
    {
        try {
            Db::beginTransaction();

            $question->setId(Uuid::uuid4()->toString());
            $question->setCreatedAt(now()->format('Y-m-d H:i:s'));
            $question->setUpdatedAt(now()->format('Y-m-d H:i:s'));

            if (!Db::table(self::TABLE_NAME)->insert($question->toArray())) {
                throw new \Exception('Error on add question.');
            }

            Db::commit();

            return $question;
        } catch (\Throwable $th) {
            Db::rollBack();
            $this->handleQueryException($th);

            throw $th;
        }
    }

    public function read(string $id): ?Question
    {
        $question = Db::table(self::TABLE_NAME)
            ->select('*')
            ->where('id', $id)
            ->first();

        if (is_null($question)) {
            return null;
        }

        return new Question(
            id: $question->id,
            title: $question->title,
            description: $question->description,
            authorId: $question->author_id,
            createdAt: $question->created_at,
            updatedAt: $question->updated_at,
        );
    }

    public function list(): array
    {
        return Db::table(self::TABLE_NAME)
            ->select('*')
            ->get()
            ->toArray();
    }

    public function addOption(QuestionOption $questionOption): QuestionOption|false
    {
        try {
            Db::beginTransaction();

            $questionOption->setId(Uuid::uuid4()->toString());
            $questionOption->setCreatedAt(now()->format('Y-m-d H:i:s'));
            $questionOption->setUpdatedAt(now()->format('Y-m-d H:i:s'));

            if (!Db::table(self::TABLE_OPTIONS_NAME)->insert($questionOption->toArray())) {
                throw new \Exception('Error on add question option.');
            }

            Db::commit();

            return $questionOption;
        } catch (\Throwable $th) {
            Db::rollBack();
            $this->handleQueryException($th);

            throw $th;
        }
    }

    public function listOptions(string $questionId): array
    {
        return Db::table(self::TABLE_OPTIONS_NAME)
            ->select('*')
            ->where('question_id', $questionId)
            ->get()
            ->toArray();
    }

    public function readOption(string $questionId, string $optionId): ?QuestionOption
    {
        $questionOption = Db::table(self::TABLE_OPTIONS_NAME)
            ->select('*')
            ->where('question_id', $questionId)
            ->where('id', $optionId)
            ->first();

        if (is_null($questionOption)) {
            return null;
        }

        return new QuestionOption(
            title: $questionOption->title,
            questionId: $questionOption->question_id,
            createdAt: $questionOption->created_at,
            updatedAt: $questionOption->updated_at,
        );
    }
}
