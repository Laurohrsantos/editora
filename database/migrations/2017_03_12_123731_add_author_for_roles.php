<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthorForRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \CodeEduUser\Models\Role::create([
            'name' => 'Autor',
            'description' => 'Permissão para criação de livros.'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAuthor = \CodeEduUser\Models\Role::where('name', 'Autor')->first();

        $roleAuthor->permissions()->detach();
        $roleAuthor->users()->detach();
        $roleAuthor->delete();
    }
}
