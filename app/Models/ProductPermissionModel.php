<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPermissionModel extends Model
{
    protected $table = 'users_products_permissions';

    protected $fillable = [
        'user_product_id', 'name', 'accesss'
    ];

}
