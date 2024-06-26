<?php

declare(strict_types=1);

namespace App\Modules\Polls\Infrastructure\Question\Repository;

use App\Modules\Polls\Domain\Question\Question;
use App\Modules\Polls\Domain\Question\QuestionAnswer;
use App\Modules\Polls\Domain\Question\QuestionOption;
use App\Modules\Polls\Domain\Question\QuestionRepositoryContract;
use App\Modules\Polls\Domain\Question\QuestionTable;
use App\Modules\Polls\Domain\User\UserTable;
use App\Modules\Shared\Infrastructure\Repository\AbstractHyperfRepository;
use Hyperf\DbConnection\Db;
use Ramsey\Uuid\Uuid;

use function Hyperf\Support\now;

class HyperfQuestionRepository extends AbstractHyperfRepository implements QuestionRepositoryContract
{
    public function add(Question $question): Question|false
    {
        try {
            Db::beginTransaction();

            $question->setId(Uuid::uuid4()->toString());
            $question->setCreatedAt(now()->format('Y-m-d H:i:s'));
            $question->setUpdatedAt(now()->format('Y-m-d H:i:s'));

            if (!Db::table(QuestionTable::QUESTIONS->value)->insert($question->toArray())) {
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
        $question = Db::table(QuestionTable::QUESTIONS->value)
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
        return Db::table(QuestionTable::QUESTIONS->value)
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

            if (!Db::table(QuestionTable::OPTIONS->value)->insert($questionOption->toArray())) {
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
        return Db::table(QuestionTable::OPTIONS->value)
            ->select('*')
            ->where('question_id', $questionId)
            ->get()
            ->toArray();
    }

    public function readOption(string $questionId, string $optionId): ?QuestionOption
    {
        $questionOption = Db::table(QuestionTable::OPTIONS->value)
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

    public function addAnswer(QuestionAnswer $questionAnswer): QuestionAnswer|false
    {
        try {
            Db::beginTransaction();

            $questionAnswer->setId(Uuid::uuid4()->toString());
            $questionAnswer->setCreatedAt(now()->format('Y-m-d H:i:s'));
            $questionAnswer->setUpdatedAt(now()->format('Y-m-d H:i:s'));

            if (!Db::table(QuestionTable::ANSWERS->value)->insert($questionAnswer->toArray())) {
                throw new \Exception('Error on add question answer.');
            }

            Db::commit();

            return $questionAnswer;
        } catch (\Throwable $th) {
            Db::rollBack();
            $this->handleQueryException($th);

            throw $th;
        }
    }

    public function listAnswers(string $questionId): array
    {
        return Db::table(sprintf('%s as u', UserTable::USERS->value))
            ->select('u.name as user_name', 'q.title as question', 'o.title as answer')
            ->join(sprintf('%s as a', QuestionTable::ANSWERS->value), 'a.user_id', '=', 'u.id')
            ->join(sprintf('%s as o', QuestionTable::OPTIONS->value), 'o.id', '=', 'a.question_option_id')
            ->join(sprintf('%s as q', QuestionTable::QUESTIONS->value), 'q.id', '=', 'o.question_id')
            ->where('q.id', $questionId)
            ->get()
            ->toArray();
    }
}
