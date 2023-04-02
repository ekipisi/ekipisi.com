<?php
namespace App\Api\Transformers;

use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

use App\Models\TicketModel;

class TicketTransformer extends TransformerAbstract
{

    public function transform(TicketModel $ticket)
    {
        return [
            'id'            => $ticket->id,
            'status'        => $ticket->status['name'],
            'departman'     => $ticket->departman['name'],
            'service'       => $ticket->service['name'],
            'priority'      => $ticket->priority['name'],
            'type'          => $ticket->type['name'],
            'title'         => $ticket->title,
            // 'message'       => $ticket->message,
            'notes'         => $ticket->notes,
            'file'          => $ticket->file,
            'ip'            => $ticket->ip,
            'created_at'    => $ticket->created_at,
            'updated_at'    => $ticket->updated_at
        ];
    }

}