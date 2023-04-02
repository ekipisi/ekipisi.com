<?php

namespace App\Api\Controllers;

use App\Models\EcommerceControllerModel;

use App\Http\Requests\EcommerceControllerRequest;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class EcommerceControllerController extends BaseController
{
    public function __construct()
    {
        $this->middleware('api.auth');
    }

    public function store(Request $request) {
        
        $controllers = json_decode($request->controllers);
        foreach($controllers as $controller) {
            $exist =  EcommerceControllerModel::where('name', $controller)->first();
            if (!$exist) {
                EcommerceControllerModel::create([
                    'name' => $controller
                ]);
            }
        }

        return $this->response->created()->setStatusCode(200);

    }

}
