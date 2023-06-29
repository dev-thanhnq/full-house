<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
