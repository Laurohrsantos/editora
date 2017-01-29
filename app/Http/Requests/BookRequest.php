<?php

namespace CodePub\Http\Requests;

use CodePub\Repositories\BookRepository;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * @var BookRepository
     */
    private $repository;

    /**
     * BookRequest constructor.
     * @param BookRepository $repository
     */
    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->method() == 'PUT' || $this->method() == 'DELETE'){
            $book_author =  $this->repository->find($this->route('book'));
            $user_id = \Auth::id();

            if ($book_author->author_id == $user_id){
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

        return [
            'title' => "required | max: 255",
            'subtitle' => "required | max: 255",
            'price' => "required | numeric"
        ];
    }
}
