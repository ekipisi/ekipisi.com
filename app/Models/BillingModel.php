<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingModel extends Model
{
    protected $table = 'billings';

    protected $fillable = [
        'service_id', 'user_id', 'domain', 'invoice_no', 'price', 'currency_id', 'payment_date', 'status', 'is_paid', 'is_paid_date', 'description'
    ];

    public function service()
    {
        return $this->hasOne(UserProductModel::class, 'id', 'service_id');
    }

    public function user()
    {
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }

    public function currency()
    {
        return $this->hasOne(CurrencyModel::class, 'id', 'currency_id');
    }

}
