<?php
namespace App\Api\Transformers;

use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

use App\Models\PartnershipModel;

class PartnershipTransformer extends TransformerAbstract
{

    public function transform(PartnershipModel $partnership)
    {
        return [
            "id"  => $partnership->id,
            "channel" => $partnership->channel,
            "firstname" => $partnership->firstname,
            "lastname" => $partnership->lastname,
            "email" => $partnership->email,
            "phone" => $partnership->phone,
            "company" => $partnership->company,
            "message" => $partnership->message,
            "status" => $partnership->status,
            "called" => $partnership->called,
            "paid" => $partnership->paid,
            "price" => $partnership->price,
            "paid_at" => $partnership->paid_at,
            "created_at" => $partnership->created_at,
            "url"  => route('user.partnership.home', ['id' => $partnership->id]),
        ];
    }

}