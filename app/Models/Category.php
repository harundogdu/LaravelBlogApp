<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function getArticleCount()
    {
        return $this->hasMany('App\Models\Article','category_id','id')->count();
    }
    public function getActiveArticleCount()
    {
        return $this->hasMany('App\Models\Article','category_id','id')->where('status',1)->count();
    }
}
