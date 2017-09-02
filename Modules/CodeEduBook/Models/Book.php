<?php

namespace CodeEduBook\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeEduBook\Models\Category;
use CodeEduUser\Models\User;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model implements TableInterface
{
    use FormAccessible;
    use softDeletes;
    use BookStorageTrait;
    use BookThumbnailTrait;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'author_id', 'title', 'subtitle', 'price', 'dedication', 'description', 'website',
        'percent_complete', 'published'
    ];

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Título', 'Subtítulo', 'Autor','Preço'];
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
            case 'Autor':
                return $this->author->name;
            case 'Preço':
                return $this->price;

        }
    }

    public  function author()
    {
        return $this->belongsTo(\CodeEduUser\Models\User::class)->withTrashed();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTrashed();
    }

    public function formCategoriesAttribute()
    {
        return $this->categories()->pluck('id')->all();
    }


}
