<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ClassJob;
use Illuminate\Support\Str;
use App\Models\CategoryType;
use Illuminate\Http\Request;
use App\Models\CategoryDetail;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->validated();
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
        return view('backend.product.edit', [
            'item'          => $product,
            'categories'    => Category::select('id', 'name')->get(),
            'details'       => CategoryDetail::select('id', 'name')->get(),
            'types'         => CategoryType::select('id', 'name')->get(),
            'classes'       => ClassJob::whereNotNull('parent_id')->select('id', 'name')->get()
        ]);
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

        return redirect()->route('dashboard.index');
    }

    /**
     * Mark product sold.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function mark_sold(Product $product)
    {
        $product->is_sold = true;
        $product->save();

        return redirect()->route('dashboard.index');
    }
}
