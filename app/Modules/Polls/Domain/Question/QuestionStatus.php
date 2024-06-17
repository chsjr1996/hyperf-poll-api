<?php

declare(strict_types=1);

namespace App\Modules\Polls\Domain\Question;

enum QuestionStatus: string
{
    case OPEN = 'open';
    case CLOSE = 'close';
}
