<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //dd($this->project);
        return [
            'title' => ['required', 'min:2', 'max:100', Rule::unique('projects')->ignore($this->project->id)],
            'description' => 'nullable|max:1000',
            'image' => 'nullable|image|max:600',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id',
            'date' => 'nullable|date',
        ];
    }
}
