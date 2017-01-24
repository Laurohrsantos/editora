<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $books = $this->route('books');
        $id = $books ? $books->id:NULL;

        return [
            'title' => "required | max: 255 | unique:books,title,$id",
            'subtitle' => "required | max: 255 | unique:books,subtitle,$id",
            'price' => "required | numeric"
        ];
    }
}
