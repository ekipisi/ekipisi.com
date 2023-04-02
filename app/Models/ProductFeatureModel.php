<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFeatureModel extends Model
{
    protected $table = 'products_features';

    protected $fillable = ['product_id', 'feature_id', 'content'];

    public function product()
    {
        return $this->hasOne(ProductModel::class, 'id', 'product_id');
    }

    public function feature()
    {
        return $this->hasOne(FeatureModel::class, 'id', 'feature_id');
    }

}
