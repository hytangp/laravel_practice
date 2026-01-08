<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUpdateProductRequest;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $products = ProductService::getProducts();
            $categories = CategoryService::getActiveCategories();

            return view('pages.products.products')->with([
                'products' => $products,
                'categories' => $categories
            ]);
        }catch(Exception $e){
            return view('pages.products.products')->with([
                'error' => 'Something went wrong.'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddUpdateProductRequest $request)
    {
        try{
            $addProduct = ProductService::addProduct($request->validated(), $request->file('image'));

            if(!$addProduct){
                throw new Exception('Failed to add product.');
            }

            $products = ProductService::getProducts();
            $data_view = view('pages.templates.products.product_listing', compact('products'))->render();

            return response()->json([
                'message' => 'Product added successfully.',
                'data' => $data_view
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Something went wrong.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $product = ProductService::getProduct($id);
            $categories = CategoryService::getActiveCategories();

            if(!$product){
                throw new Exception('Failed to fetch product.');
            }

            $data_view = view('pages.templates.products.product_add_update_form', compact('product', 'categories'))->render();

            return response()->json([
                'message' => 'Product details fetch successfully.',
                'data' => $data_view
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Something went wrong.'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddUpdateProductRequest $request, Product $product)
    {
        try{
            $updateProduct = ProductService::updateProduct($request->validated(), $request->file('image'), $product);

            if(!$updateProduct){
                throw new Exception('Failed to update product.');
            }

            $products = ProductService::getProducts();
            $data_view = view('pages.templates.products.product_listing', compact('products'))->render();

            return response()->json([
                'message' => 'Product updated successfully.',
                'data' => $data_view
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Something went wrong.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try{
            $deleteProduct = ProductService::deleteProduct($product);

            if(!$deleteProduct){
                throw new Exception('Failed to delete product.');
            }

            $products = ProductService::getProducts();
            $data_view = view('pages.templates.products.product_listing', compact('products'))->render();

            return response()->json([
                'message' => 'Product deleted successfully.',
                'data' => $data_view
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Something went wrong.'
            ], 500);
        }
    }
}
