<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnounceModel extends Model
{
    protected $table = 'announces';

    public function user()
    {
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }
}
