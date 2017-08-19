<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\CodeEduUser\Models\User::class, 1)->create([
            'email' => 'admin@editora.com'
        ]);

        factory(\CodeEduUser\Models\User::class, 1)->create([
            'email' => 'admin1@editora.com'
        ]);

        $author = factory(\CodeEduUser\Models\User::class, 1)->states('author')->create();
        $roleAuthor = \CodeEduUser\Models\Role::where('name', config('codeeduuser.acl.role_author'))->first();
        $author->roles()->attach($roleAuthor->id);
    }
}
