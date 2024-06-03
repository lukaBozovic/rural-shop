<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Polje naziv je obavezno',
            'name.string' => 'Polje naziv mora biti tekst',
            'name.min' => 'Polje naziv mora sadržavati najmanje 3 karaktera',
            'name.max' => 'Polje naziv mora sadržavati najviše 255 karaktera',
            'cover_image.required' => 'Slika je obavezna',
            'cover_image.image' => 'Slika mora biti slika',
            'cover_image.mimes' => 'Slika mora biti jednog od formata: jpeg, png, jpg, gif, svg',
            'cover_image.max' => 'Slika može imati najviše 2048kb',
        ];
    }
}
