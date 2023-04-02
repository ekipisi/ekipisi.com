<?php

namespace App\Models;

use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\ProductFeatureModel;
use App\Models\PaymentTypeModel;
use App\Models\CurrencyModel;
use App\Models\PeriodModel;

use Illuminate\Database\Eloquent\Model;

class UserProductModel extends Model
{
    protected $table = 'users_products';

    protected $fillable = [
        'user_id', 'product_id', 'cpanel_uid', 'title', 'category', 'description', 'domain', 'price', 'price_renewal', 'payment_date', 'payment_type', 'currency_id', 'period_id', 'status'
    ];

    public function user()
    {
        return $this->hasOne(UserModel::class, 'id', 'user_id');
    }

    public function product()
    {
        return $this->hasOne(ProductModel::class, 'id', 'product_id');
    }

    public function paymenttype()
    {
        return $this->hasOne(PaymentTypeModel::class, 'id', 'payment_type');
    }

    public function currency()
    {
        return $this->hasOne(CurrencyModel::class, 'id', 'currency_id');
    }

    public function period()
    {
        return $this->hasOne(PeriodModel::class, 'id', 'period_id');
    }

}
