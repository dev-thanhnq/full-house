<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publishing extends Model
{
    use SoftDeletes;
    protected $table = 'publishing_companies';

    public function products()
    {
        return $this->hasMany(Product::class, 'publishing_company_id');
    }
}
