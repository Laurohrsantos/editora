<?php

namespace CodeEduBook\Http\Requests;

use CodeEduBook\Repositories\BookRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        if ($this->method() == 'PUT' || $this->method() == 'DELETE') {

            $method = $this->method();
            $book_author = $this->route('book');
            $user_id = \Auth::user();

            if ($book_author->author_id == $user_id->id && $method == 'PUT') {
                return \Gate::allows('update', $book_author);
            }

            if ($book_author->author_id == $user_id->id && $method == 'DELETE') {
                return \Gate::allows('delete', $book_author);
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
            'price' => "required | numeric",
            'categories' => 'required | array',
            'categories.*' => 'exists:categories,id',
            'dedication' => 'required',
            'description' => 'required',
            'website' => "required | max: 255 | url",
            'percent_complete' => "required | integer | min:0",
        ];
    }

    public function messages()
    {
        $result = [];
        $categories = $this->get('categories', []);
        $count = count($categories);
        if (is_array($categories) && $count > 0) {
            foreach (range(0, $count - 1) as $value) {
                $field = \Lang::get('validation.attributes.categories_*', [
                    'num' => $value + 1
                ]);
                $message = \Lang::get('validation.exists', [
                    'attribute' => $field
                ]);
                $result["categories.$value.exists"] = $message;
            }
        }
        return $result;
    }
}
