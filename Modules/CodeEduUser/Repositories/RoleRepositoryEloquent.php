<?php

namespace CodeEduUser\Repositories;

use CodeEduUser\Models\Role;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

}
