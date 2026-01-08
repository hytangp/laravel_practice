<?php
namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public static function getCategories(){
        return Category::select('id', 'name', 'description', 'status')->get();
    }

    public static function getCategory($id){
        return Category::select('id', 'name', 'description', 'status')->where('id', $id)->first();
    }

    public static function addCategory($data){
        return Category::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'status' => $data['status']
        ]);
    }

    public static function updateCategory($data, $category){
        return $category->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'status' => $data['status']
        ]);
    }

    public static function deleteCategory($category){
        return $category->delete();
    }
}
?>