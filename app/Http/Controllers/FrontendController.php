<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ClassJob;
use App\Models\Product;
use App\Models\ProductView;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $products = Product::with('galleries', 'user_product', 'detail', 'job', 'type', 'category')
        ->withCount('view')
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
        $detail     = request()->query('category_detail_id');
        $type       = request()->query('category_type_id');

        $query = Product::with('galleries', 'user_product', 'detail', 'job', 'type', 'category')->withCount('view');

        if($category){
            $query->where('category_id', $category);
        }

        if($type){
            $query->where('category_type_id', $type);
        }

        if($detail){
            $query->where('category_details_id', $detail);
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

    public function product(Request $request, Product $product)
    {
        ProductView::createViewLog($product, $request);

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

        $product_log = ProductView::where('product_id', $product->id)->count();

        return view('frontend.detail', [
            'product' => $product,
            'product_log' => $product_log,
            'recommendations' => $recommendations,
            'product_categories' => $product_categories,
            'latest_products'   => $latest_products
        ]);
    }

    public function category(Category $category)
    {
        $products = Product::with('galleries', 'user_product', 'detail', 'job', 'type', 'category')
                        ->where('category_id', $category->id)
                        ->withCount('view')
                        ->latest()
                        ->paginate(20);

        $product_categories = Category::withCount('product')->get();
        $classes = ClassJob::select('id', 'name')->whereNotNull('parent_id')->get();

        $latest_products = Product::with('galleries', 'user_product', 'detail', 'job', 'type', 'category')
                                ->where('is_sold', false)
                                ->latest()
                                ->take(5)
                                ->get();

        return view('frontend.index')->with([
            'products' => $products,
            'product_categories' => $product_categories,
            'latest_products' => $latest_products,
            'classes'   => $classes
        ]);
    }
}
