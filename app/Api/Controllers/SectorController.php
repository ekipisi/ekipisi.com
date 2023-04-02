<?php

namespace App\Api\Controllers;

use App\Models\SectorModel;

use App\Api\Transformers\SectorTransformer;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class SectorController extends BaseController
{
	public function list()
	{
		$sectors = SectorModel::all();
		return $this->response->collection($sectors, new SectorTransformer)->setStatusCode(200);
	}
    
}
