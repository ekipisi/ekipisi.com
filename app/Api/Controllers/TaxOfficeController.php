<?php

namespace App\Api\Controllers;

use App\Models\TaxOfficeModel;

use App\Api\Transformers\TaxOfficeTransformer;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class TaxOfficeController extends BaseController
{
	public function list($zone_id)
	{
		$offices = TaxOfficeModel::where('zone_id', $zone_id)->get();
		return $this->response->collection($offices, new TaxOfficeTransformer)->setStatusCode(200);
	}


}
