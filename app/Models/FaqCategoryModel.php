<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class FaqCategoryModel extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected $table = 'faq_category';

    public function faqs()
    {
        return $this->hasMany(FaqModel::class, 'category_id');
    }

    public function category()
    {
        return $this->hasOne(FaqCategoryModel::class,'id', 'parent_id');
    }

    public function parents()
    {
        return $this->hasMany(FaqCategoryModel::class, 'parent_id');
    }

}
