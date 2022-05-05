<?php

namespace App\Http\Controllers;

use App\Models\ClassJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ClassRequest;

class ClassJobController extends Controller
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
            $query = ClassJob::with('basic_job');

            return DataTables::of($query)
                ->editColumn('basic', function($item){
                    return $item->basic_job->name ?? '-';
                })
                ->addColumn('action', function($item){
                    return '
                        <a class="inline-block border border-gray-700 bg-gray-700 text-black rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                        href="' . route('dashboard.class-job.edit', $item->slug) . '">
                            Edit
                        </a>
                        <form class="inline-block" action="' . route('dashboard.class-job.destroy', $item->slug) . '" method="POST">
                        <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('backend.classjob.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.classjob.create')->with([
            'items' => ClassJob::select('id', 'name')->where('parent_id', null)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        ClassJob::create($data);
        return redirect()->route('dashboard.class-job.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassJob  $classJob
     * @return \Illuminate\Http\Response
     */
    public function show(ClassJob $classJob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassJob  $classJob
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassJob $classJob)
    {
        return view('backend.classjob.edit', [
            'item' => $classJob,
            'class' => ClassJob::select('id', 'name')->where('parent_id', null)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassJob  $classJob
     * @return \Illuminate\Http\Response
     */
    public function update(ClassRequest $request, ClassJob $classJob)
    {
        $data = $request->validated();

        $classJob->update($data);

        return redirect()->route('dashboard.class-job.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassJob  $classJob
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassJob $classJob)
    {
        $classJob->delete();

        return redirect()->route('dashboard.class-job.index');
    }
}
