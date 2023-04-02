<?php
namespace App\Api\Transformers;

use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

use App\Models\TaxOfficeModel;

class TaxOfficeTransformer extends TransformerAbstract
{

    public function transform(TaxOfficeModel $office)
    {
        return [
            "id"    => (int)$office->id,
            "zone_id"  => $office->zone_id,
            "code"  => $office->code,
            "name"  => $office->name,
        ];
    }

}