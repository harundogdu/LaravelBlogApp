<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function getCategory()
    {
        return $this->hasOne('App\Models\Category','id','category_id');
    }
    
}
