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

    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);
        if (isset($attributes['permissions'])) {
            $model->permissions()->sync($attributes['permissions']);
        }

        return $model;
    }

    public function updatePermissions(array $permissions, $id)
    {
        $model = parent::find($id);
        $model->permissions()->detach();
        if (count($permissions)) {
            $model->permissions()->sync($permissions);
        }
        return $model;
    }
}
