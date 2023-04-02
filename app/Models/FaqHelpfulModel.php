<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqHelpfulModel extends Model
{
    protected $table = 'faq_helpful';

    protected $fillable = [
        'faq_id', 'user_id', 'rate'
    ];

}
