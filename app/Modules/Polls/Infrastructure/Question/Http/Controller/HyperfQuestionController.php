<?php

declare(strict_types=1);

namespace App\Modules\Polls\Infrastructure\Question\Http\Controller;

use App\Modules\Polls\Application\Question\UseCases\AddQuestion;
use App\Modules\Polls\Application\Question\UseCases\ListQuestions;
use App\Modules\Polls\Application\Question\UseCases\ReadQuestion;
use App\Modules\Polls\Domain\Question\QuestionRepositoryContract;
use App\Modules\Polls\Infrastructure\Question\Http\Request\StoreQuestionRequest;
use App\Modules\Shared\Infrastructure\Http\Controller\HyperfAbstractController;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;

#[Controller(prefix: '/api/v1/questions')]
class HyperfQuestionController extends HyperfAbstractController
{
    #[Inject]
    private QuestionRepositoryContract $questionRepository;

    #[GetMapping('')]
    public function index()
    {
        $questions = (new ListQuestions($this->questionRepository))->execute();

        return $this->response->json($questions);
    }

    #[GetMapping('{id}')]
    public function read($id)
    {
        $question = (new ReadQuestion($this->questionRepository))->execute($id);

        if (is_null($question)) {
            return $this->response->json([])->withStatus(404);
        }

        return $this->response->json($question);
    }

    #[PostMapping('')]
    public function store(StoreQuestionRequest $request)
    {
        try {
            $questionData = $request->validated();

            $addQuestionUseCase = new AddQuestion($this->questionRepository);
            $newQuestion = $addQuestionUseCase->execute($questionData);

            return $this->response
                ->json($newQuestion)
                ->withStatus(200);
        } catch (\Throwable $th) {
            return $this->response->json([
                'message' => $th->getMessage(),
            ])->withStatus(500);
        }
    }

    #[PutMapping('{id}')]
    public function update($id)
    {
        return $this->response->json(['message' => 'Not implemented yet.']);
    }

    #[DeleteMapping('{id}')]
    public function delete($id)
    {
        return $this->response->json(['message' => 'Not implemented yet.']);
    }
}
