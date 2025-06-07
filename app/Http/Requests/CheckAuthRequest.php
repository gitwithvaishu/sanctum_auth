<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckAuthRequest extends FormRequest
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
        return[
            'u_name'=>['required','alpha_num','min:8','max:15'],
            'email'=>['required','email','unique:checks'],
            'dob'=>['required','date'],
            'password'=>['required','min:8','max:16','confirmed',]
        ];
    }
}
