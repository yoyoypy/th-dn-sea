<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryDetailRequest;
use App\Models\Category;
use App\Models\CategoryDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryDetailController extends Controller
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
            $query = CategoryDetail::query()->with('category', 'jobclass');

            return DataTables::of($query)
                ->editColumn('jobclass', function($item){
                    return $item->jobclass->name;
                })
                ->editColumn('category', function($item){
                    return $item->category->name;
                })
                ->addColumn('action', function($item){
                    return '
                        <a class="inline-block border border-gray-700 bg-gray-700 text-black rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        href="' . route('dashboard.category-detail.edit', $item->id) . '">
                            Edit
                        </a>
                        <form class="inline-block" action="' . route('dashboard.category-detail.destroy', $item->id) . '" method="POST">
                        <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('backend.categorydetail.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('backend.categorydetail.create')->with([
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryDetailRequest $request)
    {
        $data = $request->validated();

        CategoryDetail::create($data);

        return redirect()->route('dashboard.category-detail.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryDetail  $categoryDetail
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryDetail $categoryDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryDetail  $categoryDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryDetail $categoryDetail)
    {
        return view('backend.categorydetail.edit', [
            'item' => $categoryDetail,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryDetail  $categoryDetail
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryDetailRequest $request, CategoryDetail $categoryDetail)
    {
        $data = $request->validated();

        $categoryDetail->update($data);

        return redirect()->route('dashboard.category-detail.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryDetail  $categoryDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryDetail $categoryDetail)
    {
        $categoryDetail->delete();

        return redirect()->route('dashboard.category-detail.index');
    }
}
