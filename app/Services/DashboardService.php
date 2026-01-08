<?php
namespace App\Services;

use App\CategoryStatusNamesEnum;
use App\Models\Category;
use App\Models\Product;
use App\ProductStatusNamesEnum;

class DashboardService
{
    public static function getActiveCategories(){
        return Category::with('products:id,name')->select('categories.id', 'categories.name')->where('status', CategoryStatusNamesEnum::ACTIVE->value)->get();
    }

    public static function getOtherProducts(){
        return Product::select('products.name')
            ->where('products.status', ProductStatusNamesEnum::ACTIVE->value)
            ->whereDoesntHave('linked_categories')
            ->orderBy('products.id')
            ->get();
    }
}
?>