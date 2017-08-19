<?php

namespace CodeEduBook\Repositories;

use CodePub\Criteria\CriteriaTrashedInterface;
use CodePub\Repositories\RepositoryRestoreInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ChapterRepository
 * @package namespace CodePub\Repositories;
 */
interface ChapterRepository extends RepositoryInterface, RepositoryCriteriaInterface, CriteriaTrashedInterface, RepositoryRestoreInterface
{
    //
}
