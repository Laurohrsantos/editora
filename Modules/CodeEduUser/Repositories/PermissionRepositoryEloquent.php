<?php

namespace CodeEduUser\Repositories;

use CodeEduUser\Models\Permission;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

}
