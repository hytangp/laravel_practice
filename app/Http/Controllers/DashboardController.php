<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Exception;

class DashboardController extends Controller
{
    public function index(){
        try{
            $categories = DashboardService::getActiveCategories()->toArray();
            $otherProducts = DashboardService::getOtherProducts()->pluck('name')->toArray();
            
            return view('dashboard')->with([
                'other_products' => $otherProducts,
                'categories' => $categories
            ]);
        }catch(Exception $e){
            return view('dashboard')->with([
                'error' => 'Something went wrong.'
            ]);
        }
    }
}