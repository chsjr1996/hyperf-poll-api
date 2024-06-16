<?php

declare(strict_types=1);

namespace App\Modules\Polls\Infrastructure\Question\Http\Controller;

use App\Modules\Polls\Application\Question\UseCases\AnswerQuestion;
use App\Modules\Polls\Application\Question\UseCases\RetrieveQuestionAnswers;
use App\Modules\Polls\Domain\Question\QuestionRepositoryContract;
use App\Modules\Polls\Infrastructure\Question\Http\Request\StoreQuestionAnswerRequest;
use App\Modules\Shared\Infrastructure\Http\Controller\HyperfAbstractController;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;

#[Controller(prefix: '/api/v1/question')]
class HyperfQuestionAnswerController extends HyperfAbstractController
{
    #[Inject]
    private QuestionRepositoryContract $questionRepository;

    #[GetMapping('{questionId}/answers')]
    public function index($questionId)
    {
        $questionAnswers = (new RetrieveQuestionAnswers($this->questionRepository))->execute($questionId);

        return $this->response->json($questionAnswers);
    }

    #[GetMapping('{questionId}/answers/{id}')]
    public function read($questionId, $id)
    {
        return $this->response->json([
            'message' => 'Not implemented yet.',
            'questionId' => $questionId,
            'id' => $id,
        ]);
    }

    // TODO: Use questionId to verify if the question is still opened to receive answers.
    #[PostMapping('{questionId}/answers')]
    public function store(StoreQuestionAnswerRequest $request, $questionId)
    {
        try {
            $questionOptionData = $request->validated();

            // TODO: Create a service to intercept answers and use 'Redis' ingest/digest strategy
            $addQuestionOptionUseCase = new AnswerQuestion($this->questionRepository);
            $newQuestionOption = $addQuestionOptionUseCase->execute($questionOptionData);

            return $this->response
                ->json($newQuestionOption)
                ->withStatus(200);
        } catch (\Throwable $th) {
            return $this->response->json([
                'message' => $th->getMessage(),
            ])->withStatus(500);
        }
    }

    #[PutMapping('{questionId}/answers/{id}')]
    public function update($questionId, $id)
    {
        return $this->response->json([
            'message' => 'Not implemented yet.',
            'questionId' => $questionId,
            'id' => $id,
        ]);
    }

    #[DeleteMapping('{questionId}/answers/{id}')]
    public function delete($questionId, $id)
    {
        return $this->response->json([
            'message' => 'Not implemented yet.',
            'questionId' => $questionId,
            'id' => $id,
        ]);
    }
}
