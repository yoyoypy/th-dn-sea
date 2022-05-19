<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        if (request()->ajax())
        {
            $query = Product::query()->where('user_id', Auth::user()->id)->with('job', 'category', 'detail', 'type');

            return DataTables::of($query)
                ->editColumn('category_id', function($item){
                    return $item->category->name ?? '-';
                })
                ->editColumn('category_type_id', function($item){
                    return $item->type->name ?? '-';
                })
                ->editColumn('category_detail_id', function($item){
                    return $item->detail->name ?? '-';
                })
                ->editColumn('class', function($item){
                    return $item->job->name ?? '-';
                })
                ->editColumn('price', function($item){
                    return number_format($item->price);
                })
                ->editColumn('is_sold', function($item){
                    if($item->is_sold == false) {
                       return '<span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-green-400 rounded-full">Available</span>';
                    } else {
                        return '<span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-red-400 rounded-full">SOLD</span>';
                    }
                })
                ->addColumn('action', function($item){
                    if($item->is_sold == false){
                        return '
                        <a class="inline-block border border-blue-700 bg-blue-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline"
                            href="' . route('dashboard.product.gallery.index', $item->slug) . '">
                            Add Item Photos +
                        </a>
                        <a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        href="' . route('dashboard.product.edit', $item->slug) . '">
                            Edit
                        </a>
                        <form class="inline-block" action="' . route('dashboard.mark-sold', $item->slug) . '" method="POST">
                        <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Mark Sold
                        </button>
                            ' . csrf_field() . '
                        </form>';
                    } else {
                        return '
                        <a class="inline-block border border-blue-700 bg-blue-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline"
                            href="' . route('dashboard.product.gallery.index', $item->slug) . '">
                            Add Item Photos +
                        </a>
                        <a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        href="' . route('dashboard.product.edit', $item->slug) . '">
                            Edit
                        </a>';
                    }
                })
                ->rawColumns(['action', 'is_sold'])
                ->make();
        }

        return view('backend.dashboard');
    }
}

// <form class="inline-block" action="' . route('dashboard.product.destroy', $item->slug) . '" method="POST">
//                         <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
//                             Hapus
//                         </button>
//                             ' . method_field('delete') . csrf_field() . '
//                         </form>
