<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'subcategory_id',
        'subcategory_name',
    ];

    function rel_to_category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
