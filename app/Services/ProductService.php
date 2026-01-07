<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public static function getProducts(){
        return Product::select('id', 'name', 'price', 'status', 'image')->get();
    }

    public static function getProduct($id){
        return Product::select('id', 'name', 'price', 'status', 'image')->where('id', $id)->first();
    }

    public static function addProduct($data, $file){
        if($file){
            $imagePath = $file->store('products', 'public');
        }
        
        return Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'status' => $data['status'],
            'image' => $imagePath ?? null,
        ]);
    }

    public static function updateProduct($data, $file, $product){
        if($file){
            if(!empty($product->image) && Storage::disk('public')->exists($product->image)){
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $file->store('products', 'public');
        }
        
        return $product->update([
            'name' => $data['name'],
            'price' => $data['price'],
            'status' => $data['status'],
            'image' => $imagePath ?? null,
        ]);
    }

    public static function deleteProduct($product){
        return $product->delete();
    }
}
?>