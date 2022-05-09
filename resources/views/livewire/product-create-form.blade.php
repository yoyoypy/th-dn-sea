<div>
    <form action="{{ route('dashboard.product.store') }}" class="w-full" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-wrap -mx-4 mb-6">
            {{-- input brand --}}
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Item Category*</label>
                <select wire:model="selectedCategory" name="category_id" id="category_id" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Select a Category</option>
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
                <select wire:model="selectedBaseClass" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Select a Base Class</option>
                    <option value="" disabled>------------------</option>
                    @foreach ($base_classes as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- input brand --}}
        </div>
        @if (!is_null($classes))
        <div class="flex flex-wrap -mx-4 mb-6">
            {{-- input brand --}}
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Item Class*</label>
                <select wire:model="selectedClass" name="job_id" id="job_id" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Select a Class</option>
                    <option value="" disabled>------------------</option>
                    @foreach ($classes as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- input brand --}}
        </div>
        @endif
        @if (!is_null($categoryDetail))
        <div class="flex flex-wrap -mx-4 mb-6">
            {{-- input brand --}}
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Item Detail*</label>
                <select name="category_details_id" id="category_details_id" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Select a Detail</option>
                    <option value="" disabled>------------------</option>
                    @foreach ($categoryDetail as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- input brand --}}
        </div>
        @endif
        @if (!is_null($categoryType))
        <div class="flex flex-wrap -mx-4 mb-6">
            {{-- input brand --}}
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Item Type*</label>
                <select name="category_type_id" id="category_type_id" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Select a Types</option>
                    <option value="" disabled>------------------</option>
                    @foreach ($categoryType as $t)
                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- input brand --}}
        </div>
        @endif
        <div class="flex flex-wrap -mx-4 mb-6">
            {{-- input brand --}}
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Item Name*</label>
                <input type="text" required value="{{ old('name') }}" name="name" placeholder="Input Item Name Here" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <small>warning! you cannot change item name after you post it!</small>
            </div>
            {{-- input brand --}}
        </div>
        <div class="flex flex-wrap -mx-4 mb-6">
            {{-- input description --}}
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Item Description*</label>
                <textarea name="description" rows="3" placeholder="Item Description" required class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">{!! old('description') !!}</textarea>
            </div>
            {{-- input description --}}
        </div>
        <div class="flex flex-wrap -mx-4 mb-6">
            {{-- input price --}}
            <div class="w-3/12 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Price (Gold)*</label>
                <input type="number" value="{{ old('price') }}" name="price" placeholder="Input Item Price Here" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            </div>
            {{-- input price --}}
            {{-- input price --}}
            <div class="w-3/12 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Reseal Count*</label>
                <input type="number" value="{{ old('rc') }}" name="rc" placeholder="Input Item RC Here" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            </div>
            {{-- input price --}}
            {{-- input price --}}
            <div class="w-3/12 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Value</label>
                <input type="number" value="{{ old('value') }}" name="value" placeholder="257" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <small>ex: Input 257 for 257% Rune</small>
            </div>
            {{-- input price --}}
        </div>
        <div class="flex flex-wrap -mx-4 mb-6">
            {{-- save button --}}
            <div class="w-full px-3">
                <button onclick="this.form.submit(); this.disabled=true;" type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                    Sell Item
                </button>
                <a href="{{ route('dashboard.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                    Back
                </a>
            </div>
            {{-- save button --}}
        </div>

    </form>
</div>
