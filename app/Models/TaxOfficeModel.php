<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxOfficeModel extends Model
{
    protected $table = 'tax_offices';

    protected $fillable = [
        'id', 'zone_id', 'code', 'name'
    ];

    public function zone()
    {
        return $this->hasOne(TaxOfficeModel::class, 'id', 'zone_id');
    }

}
