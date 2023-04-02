<?php
namespace App\Api\Transformers;

use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

use App\Models\SectorModel;

class SectorTransformer extends TransformerAbstract
{

    public function transform(SectorModel $sector)
    {
        return [
            "id"    => (int)$sector->id,
            "name"  => $sector->name,
        ];
    }

}