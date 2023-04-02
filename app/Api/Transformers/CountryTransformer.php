<?php
namespace App\Api\Transformers;

use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

use App\Models\CountryModel;

class CountryTransformer extends TransformerAbstract
{

    public function transform(CountryModel $country)
    {
        return [
            "id"    => (int)$country->id,
            "name"  => $country->name
        ];
    }

}