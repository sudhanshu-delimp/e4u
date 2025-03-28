<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
	protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    // public function categories()
    // {
    //     return $this->belongsTo('App\Models\PageCategory', 'category_id');
    // }

    public function categories()
    {
        return $this->belongsToMany('App\Models\PageCategory', 'page_category_relations', 'page_id', 'category_id')->withPivot('category_id');
    }
}
