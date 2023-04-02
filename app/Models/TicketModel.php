<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketModel extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'user_id', 'status_id', 'department_id', 'service_id', 'priority_id', 'type_id', 'title', 'message', 'notes', 'file', 'ip'
    ];

    public function messages()
    {
        return $this->hasMany(TicketMessageModel::class, 'ticket_id');
    }

    public function user()
    {
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }

    public function status()
    {
        return $this->hasOne(TicketStatusModel::class, 'id', 'status_id');
    }

    public function departman()
    {
        return $this->hasOne(DepartmentModel::class, 'id', 'department_id');
    }

    public function priority()
    {
        return $this->hasOne(TicketPriorityModel::class, 'id', 'priority_id');
    }

    public function type()
    {
        return $this->hasOne(TicketTypeModel::class, 'id', 'type_id');
    }

    public function product()
    {
        return $this->hasOne(UserProductModel::class, 'id', 'service_id');
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
