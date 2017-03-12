<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roleAdmin = \CodeEduUser\Models\Role::create([
            'name' => config('codeeduuser.acl.role_admin'),
            'description' => 'Papel de usuário mestre do sistema.'
        ]);

        $user = \CodeEduUser\Models\User::where('email', config('codeeduuser.user_default.email'))->first();
        $user->roles()->save($roleAdmin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAdmin = \CodeEduUser\Models\Role::where('name', 'Admin')->first();
        $user = \CodeEduUser\Models\User::where('email', config('codeeduuser.user_default.email'))->first();

        $user->roles()->detach($roleAdmin->id);
        $roleAdmin->permissions()->detach();
        $roleAdmin->users()->detach();
        $roleAdmin->delete();
    }
}
