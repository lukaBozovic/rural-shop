<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:3',
            'price' => 'required',
            'phone_number' => 'required|string|min:6|max:20',
            'city' => 'required|string|min:3|max:255',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Naslov je obavezan',
            'title.min' => 'Naslov mora imati najmanje 3 karaktera',
            'title.max' => 'Naslov može imati najviše 255 karaktera',
            'description.required' => 'Opis je obavezan',
            'description.min' => 'Opis mora imati najmanje 3 karaktera',
            'price.required' => 'Cijena je obavezna',
            'phone_number.required' => 'Broj telefona je obavezan',
            'phone_number.min' => 'Broj telefona mora imati najmanje 6 karaktera',
            'phone_number.max' => 'Broj telefona može imati najviše 15 karaktera',
            'city.required' => 'Grad je obavezan',
            'city.min' => 'Grad mora imati najmanje 3 karaktera',
            'city.max' => 'Grad može imati najviše 255 karaktera',
            'cover_image.required' => 'Slika je obavezna',
            'cover_image.image' => 'Slika mora biti slika',
            'cover_image.mimes' => 'Slika mora biti jednog od formata: jpeg, png, jpg, gif, svg',
            'cover_image.max' => 'Slika može imati najviše 2048kb',
            'images.*.image' => 'Slika mora biti slika',
            'images.*.mimes' => 'Slika mora biti jednog od formata: jpeg, png, jpg, gif, svg',
            'images.*.max' => 'Slika može imati najviše 2048kb',
            'categories.required' => 'Kategorija je obavezna',
            'categories.*.exists' => 'Kategorija ne postoji'
        ];
    }
}
