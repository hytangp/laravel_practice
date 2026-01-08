<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $categories = CategoryService::getCategories();

            return view('pages.categories.categories')->with([
                'categories' => $categories
            ]);
        }catch(Exception $e){
            return view('pages.categories.categories')->with([
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
    public function store(AddUpdateCategoryRequest $request)
    {
        try{
            $addCategory = CategoryService::addCategory($request->validated());

            if(!$addCategory){
                throw new Exception('Failed to add category.');
            }

            $categories = CategoryService::getCategories();
            $data_view = view('pages.templates.categories.category_listing', compact('categories'))->render();

            return response()->json([
                'message' => 'Category added successfully.',
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
            $category = CategoryService::getCategory($id);

            if(!$category){
                throw new Exception('Failed to fetch category.');
            }

            $data_view = view('pages.templates.categories.category_add_update_form', compact('category'))->render();

            return response()->json([
                'message' => 'Category details fetch successfully.',
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
    public function update(AddUpdateCategoryRequest $request, Category $category)
    {
        try{
            $updateCategory = CategoryService::updateCategory($request->validated(), $category);

            if(!$updateCategory){
                throw new Exception('Failed to update category.');
            }

            $categories = CategoryService::getCategories();
            $data_view = view('pages.templates.categories.category_listing', compact('categories'))->render();

            return response()->json([
                'message' => 'Category updated successfully.',
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
    public function destroy(Category $category)
    {
        try{
            $deleteProduct = CategoryService::deleteCategory($category);

            if(!$deleteProduct){
                throw new Exception('Failed to delete category.');
            }

            $categories = CategoryService::getCategories();
            $data_view = view('pages.templates.categories.category_listing', compact('categories'))->render();

            return response()->json([
                'message' => 'Category deleted successfully.',
                'data' => $data_view
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Something went wrong.'
            ], 500);
        }
    }
}
