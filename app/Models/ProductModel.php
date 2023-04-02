<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'products';

    public function currency()
    {
        return $this->hasOne(CurrencyModel::class, 'id', 'currency_id');
    }

    public function features()
    {
        return $this->hasMany(ProductFeatureModel::class, 'product_id');
    }

}
