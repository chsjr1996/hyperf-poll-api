<?php

declare(strict_types=1);

namespace App\Modules\Polls\Infrastructure\User\Http\Controller;

use App\Modules\Shared\Infrastructure\Http\Controller\HyperfAbstractController;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;

#[Controller(prefix: '/api/v1/users')]
class HyperfUserController extends HyperfAbstractController
{
    #[GetMapping('')]
    public function index()
    {
        return $this->response->json(['message' => 'Not implemented yet.']);
    }

    #[GetMapping('{id}')]
    public function read($id)
    {
        return $this->response->json(['message' => 'Not implemented yet.']);
    }

    #[PostMapping('')]
    public function store()
    {
        return $this->response->json(['message' => 'Not implemented yet.']);
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
