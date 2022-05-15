@extends('frontend.layouts.app')

@section('meta')
         <title>Offgame Trading House</title>
         <meta name="title" content="Offgame Trading House">
         <meta name="keyword" content="Offgame Trading House">
         <meta name="description" content="Offgame Trading House">
@endsection

@section('content')
{{-- Page title --}}
<section id="page-title" style="background-image:url('{{ asset('frontend/images/sh.jpg') }}');">
    <div class="container">
        <div class="page-title">
            <h1>Offgame Trading House</h1>
            {{-- <span>Sidebar Left</span> --}}
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ route('home') }}">Item List</a>
            </ul>
        </div>
    </div>
</section>
{{-- end: Page title --}}
<section id="page-content" class="sidebar-left">
    <div class="container">
        <div class="row">
            {{-- Content--}}
            <div class="content col-lg-9">
                @livewire('frontend-search-form')
                {{--Product list--}}
                <div class="shop">
                    <div class="grid-layout grid-3-columns" data-item="grid-item">
                        @forelse ($products as $product)
                            <div class="grid-item">
                                <div class="product">
                                    <div class="product-image">
                                        {{-- @foreach ($product->galleries as $gallery) --}}
                                            <a href="{{ route('product', $product->slug ) }}" title="{{ $product->name }} product image"><img style="max-height: 400px;overflow: hidden;" alt="{{ $product->name }} item image" src="{{ $product->galleries()->exists() ? Storage::url($product->galleries->first()->url) : 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==' }}">
                                            </a>
                                        {{-- @endforeach --}}
                                        <div class="product-overlay">
                                            <a href="{{ route('product', $product->slug ) }}">View Item Details</a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-category">{{ $product->job->name }}</div>
                                        <div class="product-category">{{ $product->detail->name }}</div>
                                        <div class="product-category">{{ $product->type->name }}</div>
                                        <div class="product-title">
                                            <h3><a href="{{ route('product', $product->slug ) }}">{{ $product->name }}</a></h3>
                                        </div>
                                        <div class="product-price">
                                            @if ($product->is_sold == false)
                                                {{ number_format($product->price) }} Gold
                                            @else
                                            <strike>{{ number_format($product->price) }}</strike> Gold <br>
                                            <span class="badge badge-pill badge-danger">SOLD</span>
                                            @endif
                                        </div>
                                        <div class="product-category"><i class="fa fa-eye fa-xs" aria-hidden="true"> {{ $product->view_count }}</i></div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="grid-layout grid-1-columns" data-item="grid-item">
                                <div class="grid-item">
                                    <h1>No Items Found</h1>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <hr>
                    {{-- Pagination --}}
                        <ul class="pagination">
                            {{ $products->links() }}
                        </ul>
                    {{-- end: Pagination --}}
                </div>
                {{--End: Product list--}}
            </div>
            {{-- end: Content--}}
            {{-- Sidebar--}}
            <div class="sidebar col-lg-3">
                <div class="widget clearfix widget-archive">
                    <h4 class="widget-title">Item Categories</h4>
                    <ul class="list list-lines">
                        @foreach ($product_categories as $category)
                            <li>
                                <a href="#">{{ $category->name }}</a> <span class="count">({{ $category->product_count }})</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="widget clearfix widget-shop">
                    <h4 class="widget-title">Latest Item</h4>
                    @foreach ($latest_products as $product)
                        <div class="product">
                            <div class="product-image">
                                {{-- @foreach ($product->galleries->take(1) as $gallery)
                                <a href="{{ route('product', $product->slug) }}"><img src="{{ Storage::url($gallery->url) }}" alt="Shop product image!">
                                </a>
                                @endforeach --}}
                                <a href="{{ route('product', $product->slug) }}"><img src="{{ $product->galleries()->exists() ? Storage::url($product->galleries->first()->url) : 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==' }}" alt="Shop product image!">
                                </a>
                            </div>
                            <div class="product-description">
                                <div class="product-category">{{ $product->job->name }}</div>
                                <div class="product-category">{{ $product->type->name }}</div>
                                <div class="product-category">{{ $product->detail->name }}</div><br>
                                <div class="product-title">
                                    <span class="badge badge-pill badge-success">NEW</span>
                                    <h3><a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a></h3>
                                </div>
                                <div class="product-price">{{ number_format($product->price) }} Gold
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- end: Sidebar--}}
        </div>
    </div>
</section>
@endsection
