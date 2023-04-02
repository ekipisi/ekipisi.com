<?php
namespace App\Api\Transformers;

use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

use App\Models\AnnounceSliderModel;

class AnnounceSliderTransformer extends TransformerAbstract
{

    public function transform(AnnounceSliderModel $slider)
    {
        $pattern = "/<p[^>]*><\\/p[^>]*>/"; 
        $pattern2 = "/<p[^>]*><br><\\/p[^>]*>/"; 

        $description = preg_replace($pattern, '', $slider->description);
        $description = preg_replace($pattern2, '', $description);
        
        return [
            "title"         => $slider->name,
            "description"   => $description,
            "image"         => Storage::disk('warden')->url($slider->slider),
            "url"           => $slider->url
        ];
    }

}