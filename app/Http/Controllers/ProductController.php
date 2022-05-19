<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ClassJob;
use Illuminate\Support\Str;
use App\Models\CategoryType;
use Illuminate\Http\Request;
use App\Models\CategoryDetail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax())
        {
            $query = Product::query()->with('job', 'category', 'detail', 'type')->latest();

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
                        return '
                        <a class="inline-block border border-blue-700 bg-blue-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline"
                            href="' . route('dashboard.product.gallery.index', $item->slug) . '">
                            Add Photos +
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
                        </form>
                        <form class="inline-block" action="' . route('dashboard.product.destroy', $item->slug) . '" method="POST">
                        <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->rawColumns(['action', 'is_sold'])
                ->make();
        }

        return view('backend.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.create')->with([
            'categories'    => Category::select('id', 'name')->get(),
            'details'       => CategoryDetail::select('id', 'name')->get(),
            'types'         => CategoryType::select('id', 'name')->get(),
            'classes'       => ClassJob::whereNotNull('parent_id')->select('id', 'name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name'] . '-' . Auth::user()->ign . '-' . Str::random(6));
        $data['user_id'] = Auth::user()->id;

        Product::create($data);

        return redirect()->route('dashboard.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if(Auth::user()->id == $product->user_id || Auth::user()->roles == 'ADMIN'){
            return view('backend.product.edit', [
                'item'          => $product,
                'categories'    => Category::select('id', 'name')->get(),
                'details'       => CategoryDetail::select('id', 'name')->get(),
                'types'         => CategoryType::select('id', 'name')->get(),
                'classes'       => ClassJob::whereNotNull('parent_id')->select('id', 'name')->get()
            ]);
        } else {
            return abort(403, 'Unauthorized.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->all();

        $product->update($data);

        return redirect()->route('dashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if(Auth::user()->role = 'ADMIN') {
            $product->delete();
        }

        return redirect()->route('dashboard.product.index');
    }

    /**
     * Mark product sold.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function mark_sold(Product $product)
    {
        if(Auth::user()->id == $product->user_id || Auth::user()->roles == 'ADMIN'){
            $product->is_sold = true;
            $product->save();

            return redirect()->route('dashboard.index');
        } else {
            return abort(403, 'Unauthorized.');
        }
    }
}
