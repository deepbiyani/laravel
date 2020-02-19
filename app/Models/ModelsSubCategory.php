<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelsSubCategory extends Model
{
    //
    protected $table = 'sub_categories';

    protected $fillable = [
        'name', 'description', 'parent_id'
    ];

    public function children()
    {
        return $this->hasMany('App\Models\ModelsChildCategory', 'parent_id');
    }
}
