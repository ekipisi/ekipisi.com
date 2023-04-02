<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    protected $table = 'message';

    protected $fillable = [
        'user_id', 'type', 'firstname', 'lastname', 'subject', 'email', 'phone', 'message', 'note', 'newsletter', 'read'
    ];

    public function user()
    {
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }

}
