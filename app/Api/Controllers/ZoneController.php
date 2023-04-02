<?php

namespace App\Api\Controllers;

use App\Models\CountryModel;
use App\Models\ZoneModel;

use App\Api\Transformers\CountryTransformer;
use App\Api\Transformers\ZoneTransformer;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class ZoneController extends BaseController
{
	public function country()
	{
		$country = CountryModel::where('status', 1)->get();
		return $this->response->collection($country, new CountryTransformer)->setStatusCode(200);
	}

	public function zone($id)
	{
		$zone = ZoneModel::where(['status'=> 1, 'country_id' => $id])->get();
		return $this->response->collection($zone, new ZoneTransformer)->setStatusCode(200);
	}
}
