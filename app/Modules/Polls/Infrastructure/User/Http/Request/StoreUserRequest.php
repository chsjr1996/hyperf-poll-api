<?php

declare(strict_types=1);

namespace App\Modules\Polls\Infrastructure\User\Http\Request;

use Hyperf\Validation\Request\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'mailAddress' => 'required|string|max:255',
        ];
    }
}
