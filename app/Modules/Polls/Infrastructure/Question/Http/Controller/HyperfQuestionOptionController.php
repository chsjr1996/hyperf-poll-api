<?php

declare(strict_types=1);

namespace App\Modules\Polls\Infrastructure\Question\Http\Controller;

use App\Modules\Polls\Application\Question\UseCases\AddOptionOnQuestion;
use App\Modules\Polls\Application\Question\UseCases\ListQuestionOptions;
use App\Modules\Polls\Application\Question\UseCases\ReadQuestionOption;
use App\Modules\Polls\Domain\Question\QuestionRepositoryContract;
use App\Modules\Polls\Infrastructure\Question\Http\Request\StoreQuestionOptionRequest;
use App\Modules\Shared\Infrastructure\Http\Controller\HyperfAbstractController;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;

#[Controller(prefix: '/api/v1/question')]
class HyperfQuestionOptionController extends HyperfAbstractController
{
    #[Inject]
    private QuestionRepositoryContract $questionRepository;

    #[GetMapping('{questionId}/options')]
    public function index($questionId)
    {
        $questionOptions = (new ListQuestionOptions($this->questionRepository))->execute($questionId);

        return $this->response->json($questionOptions);
    }

    #[GetMapping('{questionId}/options/{id}')]
    public function read($questionId, $id)
    {
        $questionOption = (new ReadQuestionOption($this->questionRepository))->execute($questionId, $id);

        if (is_null($questionOption)) {
            return $this->response->json([])->withStatus(404);
        }

        return $this->response->json($questionOption);
    }

    #[PostMapping('{questionId}/options')]
    public function store(StoreQuestionOptionRequest $request, $questionId)
    {
        try {
            $questionOptionData = $request->validated();

            $addQuestionOptionUseCase = new AddOptionOnQuestion($this->questionRepository);
            $newQuestionOption = $addQuestionOptionUseCase->execute($questionId, $questionOptionData);

            return $this->response
                ->json($newQuestionOption)
                ->withStatus(200);
        } catch (\Throwable $th) {
            return $this->response->json([
                'message' => $th->getMessage(),
            ])->withStatus(500);
        }
    }

    #[PutMapping('{questionId}/options/{id}')]
    public function update($questionId, $id)
    {
        return $this->response->json([
            'message' => 'Not implemented yet.',
            'questionId' => $questionId,
            'id' => $id,
        ]);
    }

    #[DeleteMapping('{questionId}/options/{id}')]
    public function delete($questionId, $id)
    {
        return $this->response->json([
            'message' => 'Not implemented yet.',
            'questionId' => $questionId,
            'id' => $id,
        ]);
    }
}
