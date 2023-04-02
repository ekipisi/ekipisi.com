<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneModel extends Model
{
    protected $table = "zone";
    protected $fillable = [
        'id', 'country_id', 'name', 'code', 'status'
    ];

    public function country()
    {
        return $this->hasOne(CountryModel::class, 'id', 'country_id');
    }

    public function taxoffices()
    {
        return $this->hasMany(TaxOfficeModel::class, 'zone_id');
    }

}
