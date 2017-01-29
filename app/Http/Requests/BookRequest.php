<?php

namespace CodePub\Http\Requests;

use CodePub\Models\Book;
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
        if ($this->method() == 'PUT'){
            $book_user =  Book::query()->find($this->route('book'))->user_id;
            $user_id = \Auth::id();

            if ($book_user == $user_id){
                return true;
            }
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('book');

        return [
            'title' => "required | max: 255 | unique:books,title,$id",
            'subtitle' => "required | max: 255 | unique:books,subtitle,$id",
            'price' => "required | numeric"
        ];
    }
}
