<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryTypeRequest;
use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryTypeController extends Controller
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
            $query = CategoryType::query()->with('category');

            return DataTables::of($query)
                ->editColumn('category', function($item){
                    return $item->category->name ?? '-';
                })
                ->addColumn('action', function($item){
                    return '
                        <a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        href="' . route('dashboard.category-type.edit', $item->id) . '">
                            Edit
                        </a>
                        <form class="inline-block" action="' . route('dashboard.category-type.destroy', $item->id) . '" method="POST">
                        <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('backend.categorytype.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categorytype.create')->with([
            'categories' => Category::select('id', 'name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryTypeRequest $request)
    {
        $data = $request->validated();

        CategoryType::create($data);

        return redirect()->route('dashboard.category-type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryType  $categoryType
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryType $categoryType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryType  $categoryType
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryType $categoryType)
    {
        return view('backend.categorytype.edit', [
            'item' => $categoryType,
            'categories' => Category::select('id', 'name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryType  $categoryType
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryTypeRequest $request, CategoryType $categoryType)
    {
        $data = $request->validated();

        $categoryType->update($data);

        return redirect()->route('dashboard.category-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryType  $categoryType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryType $categoryType)
    {
        $categoryType->delete();

        return redirect()->route('dashboard.category-type.index');
    }
}
