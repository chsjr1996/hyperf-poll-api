<?php

declare(strict_types=1);

namespace App\Modules\Polls\Infrastructure\User\Http\Controller;

use App\Modules\Polls\Application\User\UseCases\AddUser;
use App\Modules\Polls\Application\User\UseCases\ListUsers;
use App\Modules\Polls\Application\User\UseCases\ReadUser;
use App\Modules\Polls\Domain\User\UserRepositoryContract;
use App\Modules\Polls\Infrastructure\User\Http\Request\StoreUserRequest;
use App\Modules\Shared\Infrastructure\Http\Controller\HyperfAbstractController;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;

#[Controller(prefix: '/api/v1/users')]
class HyperfUserController extends HyperfAbstractController
{
    #[Inject]
    private UserRepositoryContract $userRepository;

    #[GetMapping('')]
    public function index()
    {
        $users = (new ListUsers($this->userRepository))->execute();

        return $this->response->json($users);
    }

    #[GetMapping('{id}')]
    public function read($id)
    {
        $user = (new ReadUser($this->userRepository))->execute((int) $id);

        if (is_null($user)) {
            return $this->response->json([])->withStatus(404);
        }

        return $this->response->json($user);
    }

    #[PostMapping('')]
    public function store(StoreUserRequest $request)
    {
        try {
            $userData = $request->validated();

            $addUserUseCase = new AddUser($this->userRepository);
            $newUser = $addUserUseCase->execute($userData);

            return $this->response
                ->json($newUser)
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
