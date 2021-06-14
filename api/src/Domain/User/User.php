<?php
declare(strict_types=1);

namespace App\Domain\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $table = 'user';
    protected $fillable = [
        'name',
        'mail',
        'password',
        'type',
    ];
    protected $hidden = ['password'];
}
