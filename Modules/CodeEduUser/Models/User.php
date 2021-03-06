<?php

namespace CodeEduUser\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeEduBook\Models\Book;
use CodeEduUser\Models\Role;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements TableInterface
{
    use Notifiable;
    use SoftDeletes;
    use FormAccessible;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function generatePassword($password = null)
    {
        return !$password ? (str_random(8)) : bcrypt($password);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param  Collection | string $role
     * @return boolean
     */
    public function hasRole($role)
    {
        return is_string($role) ? $this->roles->contains('name', $role) : (boolean) $role->intersect($this->roles)->count();
    }

    public function isAdmin()
    {
        return $this->hasRole(config('codeeduuser.acl.role_admin'));
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Nome', 'E-mail', 'Funções'];
    }

    public function formRolesAtrribute()
    {
        return $this->roles->pluck('id')->all();
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header) {
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
            case 'E-mail':
                return $this->email;
            case 'Funções':
                return $this->roles->implode('name', ' | ');
        }
    }
}
