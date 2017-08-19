<?php

namespace CodeEduUser\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository
 * @package namespace CodePub\Repositories;
 */
interface RoleRepository extends RepositoryInterface
{
    public function updatePermissions(array $permissions, $id);
}
