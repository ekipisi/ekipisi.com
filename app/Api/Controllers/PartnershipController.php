<?php

namespace App\Api\Controllers;

use App\Models\PartnershipModel;
use App\Http\Requests\PartnershipRequest;
use App\Api\Transformers\PartnershipTransformer;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class PartnershipController extends BaseController
{
    public function __construct()
    {
        $this->middleware('api.auth');
    }

    public function index($id)
	{
		$partnerships = PartnershipModel::where(['user_id'=> $id])->orderByDesc('created_at')->get();
		return $this->response->collection($partnerships, new PartnershipTransformer)->setStatusCode(200);
    }
    
    public function store(PartnershipRequest $request) {
        $result = PartnershipModel::create([
            'user_id' => $request->user_id,
            'channel' => 'form',
            'status' => 0,
            'called' => 0,
            'paid' => 0,
            'note' => '',
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'message' => $request->message
        ]);

        if ($result)
        {
            return $this->response->created()->setStatusCode(200);
        }

        return $this->response->errorBadRequest();
    }


}
