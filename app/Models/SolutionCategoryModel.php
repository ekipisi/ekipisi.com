<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

use App\Models\SolutionModel;

class SolutionCategoryModel extends Model implements Sortable
{
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];
    
    protected $table = 'solutions_category';

    public function solutions()
    {
        return $this->hasMany(SolutionModel::class, 'category_id');
    }

}
