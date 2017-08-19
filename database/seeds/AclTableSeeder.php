<?php

use Illuminate\Database\Seeder;

class AclTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAuthor = \CodeEduUser\Models\Role::where('name', config('codeeduuser.acl.role_author'))->first();
        $permissionsBook = \CodeEduUser\Models\Permission::where('name', 'like', '%books%')->pluck('id')->all();
        $permissionsCategory = \CodeEduUser\Models\Permission::where('name', 'like', 'category%')->pluck('id')->all();

        $roleAuthor->permissions()->attach($permissionsBook);
        $roleAuthor->permissions()->attach($permissionsCategory);
    }
}
