<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelsCategory extends Model
{

    protected $table = 'categories';

    protected $fillable = [
        'name', 'description'
    ];

    protected $casts = [
        'parent_id' =>  'integer',
    ];

    public function children()
    {
        return $this->hasMany('App\Models\ModelsSubCategory', 'parent_id');
    }
}
