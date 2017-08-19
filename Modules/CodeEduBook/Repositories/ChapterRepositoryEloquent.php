<?php

namespace CodeEduBook\Repositories;

use CodeEduBook\Models\Chapter;
use CodePub\Criteria\CriteriaTrashedTrait;
use CodePub\Repositories\RepositoryRestoreTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class BookRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class ChapterRepositoryEloquent extends BaseRepository implements ChapterRepository
{

    use CriteriaTrashedTrait;
    use RepositoryRestoreTrait;

    protected $fieldSearchable = [
        'title' => 'like',
        'subtitle' => 'like',
        'author.name' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Chapter::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
