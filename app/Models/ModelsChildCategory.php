<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelsChildCategory extends Model
{
    //
    protected $table = 'child_categories';

    protected $fillable = [
        'name', 'description', 'parent_id'
    ];

    protected $casts = [
        'parent_id' =>  'integer',
    ];
}
