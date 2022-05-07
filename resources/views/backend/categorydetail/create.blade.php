<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Category &raquo; Create
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div>
               @if ($errors->any())
               <div class="mb-5" role="alert">
                   <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                       There`s Something Wrong!
                   </div>
                   <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                       <p>
                           <ul>
                               @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                               @endforeach
                           </ul>
                       </p>
                   </div>
               </div>
               @endif
            {{-- form start --}}
            <form action="{{ route('dashboard.category-detail.store') }}" class="w-full" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-wrap -mx-4 mb-6">
                    {{-- input brand --}}
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Category</label>
                        <select name="category_id" id="category_id" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Select a Category</option>
                            <option value="" disabled>------------------</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- input brand --}}
                </div>
                <div class="flex flex-wrap -mx-4 mb-6">
                    {{-- input brand --}}
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Class</label>
                        <select name="job_id" id="job_id" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Select a Class</option>
                            <option value="" disabled>------------------</option>
                            @foreach ($jobs as $job)
                            <option value="{{ $job->id }}">{{ $job->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- input brand --}}
                </div>
                <div class="flex flex-wrap -mx-4 mb-6">
                    {{-- input brand --}}
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Category Detail</label>
                        <input type="text" required value="{{ old('name') }}" name="name" placeholder="Input Category Detail Here" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    {{-- input brand --}}
                </div>
                <div class="flex flex-wrap -mx-4 mb-6">
                    {{-- save button --}}
                    <div class="w-full px-3">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                            Save Category Detail
                        </button>
                    </div>
                    {{-- save button --}}
                </div>

            </form>
            {{-- form end --}}
           </div>
        </div>
    </div>
</x-app-layout>
