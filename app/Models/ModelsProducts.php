<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelsProducts extends Model
{
    //
    protected $table = 'products';

    protected $fillable = [
        'name', 'description'
    ];

    public function categoryDetails()
    {
        return $this->belongsTo('App\Models\ModelsCategory', 'category', 'id');
    }

    public function subCategoryDetails()
    {
        return $this->belongsTo('App\Models\ModelsSubCategory', 'sub_category', 'id');
    }

    public function childCategoryDetails()
    {
        return $this->belongsTo('App\Models\ModelsChildCategory', 'child_category', 'id');
    }

}
