<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function attributes(){
        return $this->hasMany('App\Models\Attribute', 'category_id', 'id');
    }

}
