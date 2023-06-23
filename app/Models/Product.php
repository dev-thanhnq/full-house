<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    protected $fillable = ['name','slug', 'origin_price', 'sale_price', 'discount_percent', 'author_id', 'content', 'publishing_company_id', 'pages_count', 'status', 'rate'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publishing_company()
    {
        return $this->belongsTo(Publishing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
