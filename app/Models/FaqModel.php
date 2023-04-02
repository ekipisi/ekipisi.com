<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class FaqModel extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected $table = 'faq';

    public function category()
    {
        return $this->hasOne(FaqCategoryModel::class, 'id', 'category_id');
    }

    public function helpful()
    {
        return $this->hasMany(FaqHelpfulModel::class, 'faq_id');
    }

}
