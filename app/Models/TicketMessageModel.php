<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketMessageModel extends Model
{
    protected $table = 'tickets_messages';
    protected $fillable = [
        'ticket_id', 'assign_id', 'user_id', 'message', 'file', 'ip'
    ];

    
    public function ticket()
    {
        return $this->hasOne(TicketModel::class, 'id', 'ticket_id');
    }

    public function admin()
    {
        return $this->hasOne(AdminModel::class, 'id', 'assign_id');
    }

    public function user()
    {
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }

    public function setFileAttribute($file)
    {
        if (is_array($file)) {
            $this->attributes['file'] = json_encode($file);
        }
    }

    public function getFileAttribute($file)
    {
        return json_decode($file, true);
    }

}
