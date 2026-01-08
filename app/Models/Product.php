<?php

namespace App\Models;

use App\ProductStatusNamesEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'price', 'status', 'image'];

    public function linked_categories(){
        return $this->hasMany(ProductCategory::class, 'product_id', 'id');
    }

    public function getStatusNameAttribute()
    {
        return ProductStatusNamesEnum::from($this->status)->label(); 
    }
}