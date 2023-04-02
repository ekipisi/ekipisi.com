<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNoteModel extends Model
{
    protected $table = 'users_notes';

    protected $fillable = [
        'user_id', 'priority', 'status', 'note', 'end_at'
    ];

}
