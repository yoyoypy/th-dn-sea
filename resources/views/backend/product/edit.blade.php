<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Item &raquo; {{ $item->name }} &raquo; Edit
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
            <form action="{{ route('dashboard.product.update', $item->slug) }}" class="w-full" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-wrap -mx-4 mb-6">
                    {{-- input brand --}}
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Item Category*</label>
                        <select name="category_id" id="category_id" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="{{ $item->category->id }}">{{ $item->category->name }}</option>
                            <option value="" disabled>------------------</option>
                            @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- input brand --}}
                </div>
                <div class="flex flex-wrap -mx-4 mb-6">
                    {{-- input brand --}}
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Item Class*</label>
                        <select name="job_id" id="job_id" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="{{ $item->job->id }}">{{ $item->job->name }}</option>
                            <option value="" disabled>------------------</option>
                            @foreach ($classes as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- input brand --}}
                </div>
                <div class="flex flex-wrap -mx-4 mb-6">
                    {{-- input brand --}}
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Item Detail*</label>
                        <select name="category_details_id" id="category_details_id" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="{{ $item->detail->id }}">{{ $item->detail->name }}</option>
                            <option value="" disabled>------------------</option>
                            @foreach ($details as $d)
                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- input brand --}}
                </div>
                <div class="flex flex-wrap -mx-4 mb-6">
                    {{-- input brand --}}
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Item Type*</label>
                        <select name="category_type_id" id="category_type_id" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="{{ $item->type->id }}">{{ $item->type->name }}</option>
                            <option value="" disabled>------------------</option>
                            @foreach ($types as $t)
                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- input brand --}}
                </div>
                <div class="flex flex-wrap -mx-4 mb-6">
                    {{-- input brand --}}
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Item Name*</label>
                        <input type="text" disabled required value="{{ old('name') ?? $item->name }}" name="name" placeholder="Input Item Name Here" class="block w-full bg-gray-700 text-white border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    {{-- input brand --}}
                </div>
                <div class="flex flex-wrap -mx-4 mb-6">
                    {{-- input description --}}
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Item Description*</label>
                        <textarea name="description" rows="3" value="{{ $item->description }}" placeholder="Item Description" required class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">{!! old('description') !!}</textarea>
                    </div>
                    {{-- input description --}}
                </div>
                <div class="flex flex-wrap -mx-4 mb-6">
                    {{-- input price --}}
                    <div class="w-3/12 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Price (Gold)*</label>
                        <input type="number" value="{{ old('price') ?? $item->price }}" name="price" placeholder="Input Item Price Here" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    {{-- input price --}}
                    {{-- input price --}}
                    <div class="w-3/12 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Reseal Count*</label>
                        <input type="number" value="{{ old('rc') ?? $item->rc }}" name="rc" placeholder="Input Item RC Here" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </div>
                    {{-- input price --}}
                    {{-- input price --}}
                    <div class="w-3/12 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Value</label>
                        <input type="number" value="{{ old('value') ?? $item->value }}" name="value" placeholder="257" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <small>ex: Input 257 for 257% Rune</small>
                    </div>
                    {{-- input price --}}
                </div>
                <div class="flex flex-wrap -mx-4 mb-6">
                    {{-- save button --}}
                    <div class="w-full px-3">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                            Sell Item
                        </button>
                        <a href="{{ route('dashboard.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                            Back
                        </a>
                    </div>
                    {{-- save button --}}
                </div>

            </form>
            {{-- form end --}}
           </div>
        </div>
    </div>
</x-app-layout>
