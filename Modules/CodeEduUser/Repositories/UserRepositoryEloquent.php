<?php

namespace CodeEduUser\Repositories;

use CodeEduUser\Http\Requests\UserRequest;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduUser\Models\User;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{

    public function create(array $attributes)
    {
        $attributes['password'] = User::generatePassword();
        $model = parent::create($attributes);
        if (isset($attributes['roles'])) {
            $model->roles()->sync($attributes['roles']);
        }

        \UserVerification::generate($model);

        $subject = config('codeeduuser.email.user_created.subject');
        \UserVerification::emailView('codeeduuser::emails.user-create');

        \UserVerification::send($model, $subject);

        return $model;
    }

    public function update(array $attributes, $id)
    {
        if (isset($attributes['password'])) {
            $attributes['password'] = User::generatePassword($attributes['password']);
        }
        $model = parent::update($attributes, $id);
        if (isset($attributes['roles'])) {
            $model->roles()->sync($attributes['roles']);
        }

        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}