<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    //

    protected $table = 'attribute';

    public $timestamps = false;

    public function category(){
        return $this->belongsTo('App\models\Category', 'category_id', 'id');
    }
}
