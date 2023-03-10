<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    public function section()
    {
        //dd($this->belongsTo('App\Models\Section', 'section_id')->select('id', 'name'));
        return $this->belongsTo('App\Models\Section', 'section_id')->select('id', 'name');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id')->select('id', 'category_name');
    }
}
