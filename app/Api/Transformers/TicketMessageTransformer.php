<?php
namespace App\Api\Transformers;

use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

use App\Models\TicketMessageModel;

class TicketMessageTransformer extends TransformerAbstract
{

    public function transform(TicketMessageModel $message)
    {
        return [
            'id'            => $message->id,
            'ticket_id'     => $message->ticket_id,
            'assign_name'   => $message->admin['name'],
            'message'       => $message->message,
            'file'          => $message->file,
            'ip'            => $message->ip,
            'created_at'    => $message->created_at,
            'updated_at'    => $message->updated_at
        ];
    }

}