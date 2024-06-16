<?php

declare(strict_types=1);

namespace App\Modules\Polls\Infrastructure\Question\Http\Request;

use Hyperf\Validation\Request\FormRequest;

class StoreQuestionOptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
        ];
    }
}
