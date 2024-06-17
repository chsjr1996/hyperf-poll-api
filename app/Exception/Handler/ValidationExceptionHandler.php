<?php

declare(strict_types=1);
/**
 * Modified version of \Hyperf\Validation\ValidationExceptionHandler that returns a json response
 * with all errors.
 */

namespace App\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Validation\ValidationException;
use Swow\Psr7\Message\ResponsePlusInterface;
use Throwable;

class ValidationExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponsePlusInterface $response)
    {
        $this->stopPropagation();
        /** @var ValidationException $throwable */
        $errors = $throwable->validator->errors()->all();
        $errorResponse = ['errors' => $errors];

        $response = $response->addHeader('content-type', 'application/json');

        return $response->setStatus($throwable->status)
            ->setBody(new SwooleStream(json_encode($errorResponse)));
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ValidationException;
    }
}
