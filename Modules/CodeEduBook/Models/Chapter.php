<?php

namespace CodeEduBook\Models;

use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;

class Chapter extends Model implements TableInterface
{
    protected $fillable = [
        'name', 'content', 'order', 'book_id'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function getTableHeaders()
    {
        return ['#', 'Nome', 'Ordem'];
    }

    public function getValueForHeader($headers)
    {
        switch ($headers) {
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
            case 'Ordem':
                return $this->order;
        }
    }

}
