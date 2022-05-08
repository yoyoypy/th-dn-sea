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
                <div class="row m-b-20">
                    <div class="col-lg-3">
                        <div class="order-select">
                            <h6>Sort by</h6>
                            <p>Showing 1&ndash;12 of 25 results</p>
                            <form method="get">
                                <select class="form-control">
                                    <option selected="selected" value="order">Default sorting</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by newness</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="order-select">
                            <h6>Sort by Price</h6>
                            <p>From 0 - 190$</p>
                            <form method="get">
                                <select class="form-control">
                                    <option selected="selected" value="">0$ - 50$</option>
                                    <option value="">51$ - 90$</option>
                                    <option value="">91$ - 120$</option>
                                    <option value="">121$ - 200$</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                {{--Product list--}}
                <div class="shop">
                    <div class="grid-layout grid-3-columns" data-item="grid-item">
                        @foreach ($products as $product)
                            <div class="grid-item">
                                <div class="product">
                                    <div class="product-image">
                                        @foreach ($product->galleries as $gallery)
                                            <a href="{{ Storage::url($gallery->url) }}" title="{{ $product->name }} product image"><img style="max-height: 400px;overflow: hidden;" alt="{{ $product->name }} product image" src="{{ Storage::url($gallery->url) }}">
                                            </a>
                                        @endforeach
                                        <div class="product-overlay">
                                            <a href="{{ route('product', $product->slug ) }}">View Item Details</a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-category">{{ $product->category->name }}</div>
                                        <div class="product-category">{{ $product->job->name }}</div>
                                        <div class="product-category">{{ $product->type->name }}</div>
                                        <div class="product-title">
                                            <h3><a href="{{ route('product', $product->slug ) }}">{{ $product->name }}</a></h3>
                                        </div>
                                        <div class="product-price">
                                            @if ($product->is_sold == false)
                                                {{ number_format($product->price) }} Gold
                                            @else
                                            <span class="badge badge-pill badge-danger">SOLD</span><strike>{{ number_format($product->price) }}</strike> Gold
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                                <a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a> <span class="count">({{ $category->product_count }})</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="widget clearfix widget-shop">
                    <h4 class="widget-title">Latest Item</h4>
                    @foreach ($latest_products as $product)
                        <div class="product">
                            <div class="product-image">
                                <a href="{{ route('product', $product->slug) }}"><img src="#" alt="Shop product image!">
                                </a>
                            </div>
                            <div class="product-description">
                                <div class="product-category">{{ $product->category->name }}</div>
                                <div class="product-title">
                                    <h3><a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a></h3>
                                </div>
                                <div class="product-price">Rp{{ number_format($product->price) }}
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