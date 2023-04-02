<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminModel extends Authenticatable
{
    use Notifiable;
    protected $table = "admin_users";
    protected $fillable = [
        'id', 'username', 'name', 'avatar'
    ];

}