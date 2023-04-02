<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnershipModel extends Model
{
    protected $table = 'partnerships';

    protected $fillable = [
        'user_id', 'assign_id', 'channel', 'firstname', 'lastname', 'email', 'phone', 'company', 'message', 'status', 'called', 'paid', 'price', 'note', 'paid_at'
    ];

    public function user()
    {
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }

}
