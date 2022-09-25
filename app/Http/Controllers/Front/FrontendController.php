<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class FrontendController extends Controller
{
    public function index(){
        
        return view('frontend.index');
    }
    public function about(){
        $page_title = 'About Us';
        return view('frontend.about', compact('page_title'));
    }
    public function product(){
        $page_title = 'Product';
        return view('frontend.product', compact('page_title'));
    }
    public function details(){
        $page_title = 'Product Details';
        return view('frontend.details', compact('page_title'));
    }
    public function services(){
        $page_title = 'Services';
        return view('frontend.services', compact('page_title'));
    }
    public function events(){
        $page_title = 'Events';
        return view('frontend.events', compact('page_title'));
    }
    public function cat_details($slug){
        $category = Category::with('children')->where('cat_slug', $slug)->first();
        dd($category);
    }
}
