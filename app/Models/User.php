<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    public $fillables = [
        'username',
        'password',
        'last_login',
    ];

    public $hidden = [
        'password',
    ];

    public function notes(){
        return $this->hasMany(Note::class, 'user_id', 'id');
    }    
}
