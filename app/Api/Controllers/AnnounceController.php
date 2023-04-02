<?php

namespace App\Api\Controllers;

use App\Models\AnnounceModel;

use App\Api\Transformers\AnnounceTransformer;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class AnnounceController extends BaseController
{

    public function list($domain)
	{
		$today = date('Y-m-d');
		$announces = AnnounceModel::where(['status'=> 1])
						->where('date_start', '<=', $today)
						->where('date_end', '>=', $today)
						->orderByDesc('created_at');

		$announces = $announces->where('domain', 'none')->orWhere('domain', $domain)->get();

		return $this->response->collection($announces, new AnnounceTransformer)->setStatusCode(200);
	}
}
