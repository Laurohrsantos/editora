<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Book extends Model implements TableInterface
{
    protected $fillable = [
        'title', 'subtitle', 'price',
    ];

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Título', 'Subtítulo', 'Preço'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#':
                return $this->id;
            case 'Título':
                return $this->title;
            case 'Subtítulo':
                return $this->subtitle;
            case 'Preço':
                return $this->price;

        }
    }

    public  function user()
    {
        return $this->belongsTo(User::class);
    }
}
