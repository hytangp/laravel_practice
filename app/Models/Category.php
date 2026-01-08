<?php

namespace App\Models;

use App\CategoryStatusNamesEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'status'];

    public function getStatusNameAttribute()
    {
        return CategoryStatusNamesEnum::from($this->status)->label();
    }

    public function getCatNameAttribute()
    {
        return ucfirst($this->name);
    }
}