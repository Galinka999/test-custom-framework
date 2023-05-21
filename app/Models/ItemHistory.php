<?php

declare(strict_types=1);

namespace App\Models;

use \Illuminate\Database\Eloquent\Model as Model;

class ItemHistory extends Model
{
    public $timestamps = false;
    protected $table = 'item_history';

    protected $fillable = [
       'item_id', 'data', 'created_at'
    ];

    protected $casts = [
        'created_at' => 'date',
        'data' => 'json',
    ];
}