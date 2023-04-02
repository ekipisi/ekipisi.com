<?php
namespace App\Api\Transformers;

use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

use App\Models\AnnounceModel;

class AnnounceTransformer extends TransformerAbstract
{

    public function transform(AnnounceModel $announce)
    {
        $pattern = "/<p[^>]*><\\/p[^>]*>/"; 

        return [
            "title"  => $announce->title,
            "content" => preg_replace($pattern, '', $announce->content),
            "url"  => route('user.announce', ['id' => $announce->id, 'domain' => $announce->domain]),
        ];
    }

}