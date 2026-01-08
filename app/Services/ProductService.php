<?php
namespace App\Services;

use App\Models\Product;
use App\Models\ProductCategory;
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
        
        $product = Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'status' => $data['status'],
            'image' => $imagePath ?? null,
        ]);

        if(isset($data['categories'])){
            foreach($data['categories'] as $category){
                ProductCategory::create([
                    'product_id' => $product->id,
                    'category_id' => $category,
                ]);
            }
        }

        return $product;
    }

    public static function updateProduct($data, $file, $product){
        if($file){
            if(!empty($product->image) && Storage::disk('public')->exists($product->image)){
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $file->store('products', 'public');
        }

        $produtCategories = $product->linked_categories;

        if($produtCategories->isNotEmpty()){
            $produtCategories->whereNotIn('category_id', $data['categories'])->each(function($item){
                $item->delete();
            });
        }

        if(isset($data['categories'])){
            foreach($data['categories'] as $category){
                ProductCategory::updateOrCreate([
                    'product_id' => $product->id,
                    'category_id' => $category,
                ]);
            }
        }
        
        return $product->update([
            'name' => $data['name'],
            'price' => $data['price'],
            'status' => $data['status'],
            'image' => $imagePath ?? ($product->image ?? null),
        ]);
    }

    public static function deleteProduct($product){
        return $product->delete();
    }
}
?>