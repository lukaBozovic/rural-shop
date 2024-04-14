<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Polje ime je obavezno.',
            'name.min' => 'Polje ime ne smije biti kraće od :min karaktera.',
            'name.max' => 'Polje ime ne smije biti duže od :max karaktera.',
            'name.string' => 'Polje ime mora biti tekst.',
            'email.required' => 'Polje email je obavezno.',
            'email.email' => 'Polje email mora biti validna email adresa.',
            'email.unique' => 'Polje email već postoji u bazi podataka.',
        ];
    }
}
