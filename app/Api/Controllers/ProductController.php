<?php

namespace App\Api\Controllers;

use App\Models\ProductModel;

use App\Api\Transformers\ProductTransformer;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class ProductController extends BaseController
{

    public function detail($id)
	{
		$product = ProductModel::where(['status'=> 1, 'id' => $id])->first();
		return $this->response->item($product, new ProductTransformer)->setStatusCode(200);
	}
}
