<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\TaskPriority;
use App\Enums\TaskStatus;

class StoreTaskRequest extends FormRequest
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
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'priority' => [
                'required',
                new Enum(TaskPriority::class),
            ],

            'status' => [
                'required',
                new Enum(TaskStatus::class),
            ],

            'due_date' => [
                'nullable',
                'date',
            ],
        ];
    }
}
