<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    protected $table = "country";
    protected $fillable = [
        'id', 'name', 'iso_code_2', 'iso_code_3', 'address_format', 'postcode_required', 'status'
    ];

    public function zone()
    {
        return $this->hasMany(ZoneModel::class, 'country_id');
    }
}
