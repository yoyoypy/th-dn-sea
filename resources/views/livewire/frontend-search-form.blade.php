<div>
    <form action="{{ route('search') }}" method="GET">
        <div class="row m-b-20">
            <div class="col-lg-3">
                <div class="order-select" wire:ignore>
                    <p>Base Class</p>
                    <select class="form-control" wire:model="selectedBaseClass">
                        <option value="">Select Base Class</option>
                        <option value="" disabled>--------------</option>
                        @foreach ($base_classes as $base_class)
                        <option value="{{ $base_class->id }}">{{ $base_class->name }}</option>
                        @endforeach
                    </select>
                </div><br>
                <div class="order-select">
                    <p>Category</p>
                    <select class="form-control" wire:model="selectedCategory" name="category_id" id="category_id">
                        <option value="">Select Category</option>
                        <option value="" disabled>--------------</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                @if (!is_null($classes))
                <div class="order-select">
                    <p>Class</p>
                    <select class="form-control" wire:model="selectedClass" name="job_id" id="job_id">
                        <option value="">Select Class</option>
                        <option value="" disabled>--------------</option>
                        @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <br>
                @if (!is_null($categoryDetail))
                <div class="order-select">
                    <p>Detail Item</p>
                    <select class="form-control" name="category_detail_id" id="category_detail_id">
                        <option value="">Select Item Detail</option>
                        <option value="" disabled>--------------</option>
                            @foreach ($categoryDetail as $detail)
                                <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                            @endforeach
                    </select>
                </div>
                @endif
            </div>
            <div class="col-lg-3">
                <div class="order-select">
                    <p>Item Name</p>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Input Item Name">
                </div>
                <br>
                <div class="order-select">
                    <button type="submit" class="btn btn-primary btn-sm">
                        Find Item
                    </button>
                    <small style="margin: 5%"><a href="{{ route('home') }}">Reset Filter</a></small>
                </div>
            </div>
        </div>
    </form>
</div>
