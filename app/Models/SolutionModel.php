<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

use App\Models\SolutionCategoryModel;

class SolutionModel extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected $table = 'solutions';

    public function category()
    {
        return $this->hasOne(SolutionCategoryModel::class, 'id', 'category_id');
    }

}
