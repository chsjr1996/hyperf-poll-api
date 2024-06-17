<?php

declare(strict_types=1);

namespace App\Modules\Polls\Infrastructure\Question\Http\Request;

use App\Modules\Polls\Domain\Question\QuestionStatus;
use Hyperf\Validation\Request\FormRequest;
use Hyperf\Validation\Rule;

class StoreQuestionRequest extends FormRequest
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
        $validStatusArr = [
            QuestionStatus::OPEN->value,
            QuestionStatus::CLOSE->value,
        ];

        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'authorId' => 'required|string',
            'status' => ['required', Rule::in($validStatusArr)],
            'closeAt' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'status.required' => 'Status is required',
            'status.in' => 'Status is not valid. Accept values are \'open\' or \'close\'',
        ];
    }
}
