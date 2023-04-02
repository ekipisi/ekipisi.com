<?php

namespace App\Http\Controllers;

use App\Models\UserMailActivityModel;

use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function ga($id)
    {
        UserMailActivityModel::find($id)->update(['read' => 1]);
        return \Image::make('public/images/ga.png')->response('png');
    }
}
