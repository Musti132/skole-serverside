<?php

namespace App\Http\Requests\Channel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MessageAiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'message' => ['required', 'string'],
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json($validator->errors()->all(), 422));
    }
}
