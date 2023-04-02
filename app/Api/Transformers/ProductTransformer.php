<?php
namespace App\Api\Transformers;

use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

use App\Models\ProductModel;

class ProductTransformer extends TransformerAbstract
{

    public function transform(ProductModel $product)
    {
        return [
            "id"    => (int)$product->id,
            "title"  => $product->title,
            "description" => $product->description,
            "price" => $product->price,
            "price_renewal" => $product->price_renewal,
            "currency_id" => $product->currency_id,
            "period" => $product->period
        ];
    }

}