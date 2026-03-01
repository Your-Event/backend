<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUserType extends Model
{
    use SoftDeletes;

    protected $table = 'role_user_type';

    protected $fillable = [
        'role_id',
        'user_type_id',
    ];
}
