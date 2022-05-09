<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ClassJob;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $products = Product::with('galleries', 'user_product', 'detail', 'job', 'type', 'category')
        ->latest()->paginate(20);

        $product_categories = Category::withCount('product')->get();
        $classes = ClassJob::select('id', 'name')->whereNotNull('parent_id')->get();
        $latest_products = Product::with('galleries', 'user_product', 'detail', 'job', 'type', 'category')->where('is_sold', false)->latest()->take(5)->get();

        return view('frontend.index')->with([
            'products' => $products,
            'product_categories' => $product_categories,
            'latest_products' => $latest_products,
            'classes'   => $classes
        ]);
    }

    public function search()
    {
        $category   = request()->query('category_id');
        $job        = request()->query('job_id');
        $name       = request()->query('name');

        $query = Product::with('galleries', 'user_product', 'detail', 'job', 'type', 'category');

        if($category){
            $query->where('category_id', $category);
        }

        if($job){
            $query->where('job_id', $job);
        }

        if($name){
            $query->where('name', 'LIKE', '%'.$name.'%');
        }

        $products = $query->latest()->paginate(20);
        $product_categories = Category::withCount('product')->get();
        $classes = ClassJob::select('id', 'name')->whereNotNull('parent_id')->get();
        $latest_products = Product::with('galleries', 'user_product', 'detail', 'job', 'type', 'category')->where('is_sold', false)->latest()->take(5)->get();

        return view('frontend.index')->with([
            'products' => $products,
            'product_categories' => $product_categories,
            'latest_products' => $latest_products,
            'classes'   => $classes
        ]);
    }

    public function product(Product $product)
    {

        $product_categories = Category::withCount('product')->get();

        $latest_products = Product::with('galleries', 'user_product', 'detail', 'job', 'type', 'category')
            ->where('is_sold', false)
            ->latest()
            ->take(5)
            ->get();

        $recommendations = Product::where('is_sold', false)
        ->where('category_type_id', $product->category_type_id)
        ->where('job_id', $product->job_id)
        ->latest()
        ->take(3)
        ->get();

        return view('frontend.detail', [
            'product' => $product,
            'recommendations' => $recommendations,
            'product_categories' => $product_categories,
            'latest_products'   => $latest_products
        ]);
    }
}
