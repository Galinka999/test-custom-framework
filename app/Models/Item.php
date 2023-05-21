<?php

declare(strict_types=1);

namespace App\Models;

use \Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    protected $fillable = [
        'name', 'phone', 'key'
    ];

    public function historyChange(): HasMany
    {
        return $this->hasMany(ItemHistory::class);
    }
}