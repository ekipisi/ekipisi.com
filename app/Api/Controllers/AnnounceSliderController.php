<?php

namespace App\Api\Controllers;

use App\Models\AnnounceSliderModel;

use App\Api\Transformers\AnnounceSliderTransformer;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class AnnounceSliderController extends BaseController
{

    public function list()
	{
		$sliders = AnnounceSliderModel::where(['status'=> 1])->orderByDesc('created_at')->get();
		return $this->response->collection($sliders, new AnnounceSliderTransformer)->setStatusCode(200);
	}
}
