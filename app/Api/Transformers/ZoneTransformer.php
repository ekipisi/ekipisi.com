<?php
namespace App\Api\Transformers;

use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

use App\Models\ZoneModel;

class ZoneTransformer extends TransformerAbstract
{

    public function transform(ZoneModel $zone)
    {
        return [
            "id"    => (int)$zone->id,
            "name"  => $zone->name
        ];
    }

}