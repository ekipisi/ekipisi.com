<?php

namespace App\Api\Controllers;

use App\Models\TicketModel;
use App\Models\TicketMessageModel;

use App\Api\Transformers\TicketTransformer;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class TicketController extends BaseController
{

    public function __construct()
    {
        $this->middleware('api.auth');
    }

	public function list($user_id)
	{
		$tickets = TicketModel::where('user_id', $user_id)->orderByDesc('created_at')->paginate(10);
		return $this->response->paginator($tickets, new TicketTransformer)->setStatusCode(200);
	}

	public function list_detail($user_id){

		$ticket_list = [];

		$tickets = TicketModel::where(['user_id'=> $user_id])->orderByDesc('created_at')->get();

		foreach($tickets as $ticket) {

			$message_list = [];

			$messages = TicketMessageModel::where(['ticket_id' => $ticket->id])->get();

			foreach($messages as $message) {
				$message_list[] = [
					'id'            => $message->id,
					'ticket_id'     => $message->ticket_id,
					'assign_name'   => $message->admin['name'],
					'message'       => $message->message,
					'file'          => $message->file,
					'created_at'    => $message->created_at,
					'updated_at'    => $message->updated_at
				];
			}

			$ticket_list[] = [
				'id'            => $ticket->id,
				'status'        => $ticket->status['name'],
				'departman'     => $ticket->departman['name'],
				'service'       => $ticket->service['name'],
				'priority'      => $ticket->priority['name'],
				'type'          => $ticket->type['name'],
				'title'         => $ticket->title,
				'message'       => $ticket->message,
				'notes'         => $ticket->notes,
				'file'          => $ticket->file,
				'created_at'    => $ticket->created_at,
				'updated_at'    => $ticket->updated_at,
				'messages'		=> $message_list
			];
		}

		return $ticket_list;
	}

	public function detail($user_id, $ticket_id){
		$ticket = TicketModel::where(['id' => $ticket_id, 'user_id'=> $user_id])->orderByDesc('created_at')->first();
		
		$ticket_messages = [];

		$messages = TicketMessageModel::where(['ticket_id' => $ticket->id])->get();

		foreach($messages as $message) {
			$ticket_messages[] = [
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

		$data = [
            'id'            => $ticket->id,
            'status'        => $ticket->status['name'],
            'departman'     => $ticket->departman['name'],
            'service'       => $ticket->service['name'],
            'priority'      => $ticket->priority['name'],
            'type'          => $ticket->type['name'],
            'title'         => $ticket->title,
            'message'       => $ticket->message,
            'notes'         => $ticket->notes,
            'file'          => $ticket->file,
            'ip'            => $ticket->ip,
            'created_at'    => $ticket->created_at,
			'updated_at'    => $ticket->updated_at,
			'messages'		=> $ticket_messages
		];

		return $data;
	}



}
