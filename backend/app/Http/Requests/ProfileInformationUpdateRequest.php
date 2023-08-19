<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileInformationUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'bio' => ['required', 'string', 'max:1024'],
            'occupation' => ['required', 'max:255'],
            'start_time' => ['required', 'date_format:H\:i'],
            'end_time' => ['required', 'date_format:H\:i'],
            'twitter_url' => ['nullable', 'url'],
            'linkedin_url' => ['nullable', 'url'],
        ];
    }
}
