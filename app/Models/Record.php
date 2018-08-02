<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    //表名
    protected $table = 'records';

    //时间戳格式
    //protected $dateFormat = 'Y-m-d H:i:s';

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'type', 'datetime', 'action', 'amount', 'tag', 'note', 'is_delete'];
}
