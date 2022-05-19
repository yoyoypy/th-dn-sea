@extends('frontend.layouts.app')

@section('meta')
         <title>{{ $product->name }}</title>
         <meta name="title" content="{{ $product->name }}">
         <meta name="keyword" content="{{ $product->name }}">
         <meta name="description" content="{!! Str::limit($product->description, 70) !!}">
@endsection

@section('content')
<section id="page-content" class="sidebar-right">
    <div class="container">
        <div class="row">
            {{-- Content--}}
            <div class="content col-lg-9">
                <div class="product">
                    <div class="row m-b-40">
                        <div class="col-lg-5">
                            <div class="product-image">
                                {{-- Carousel slider --}}
                                <div class="carousel dots-inside dots-dark arrows-visible" data-items="1" data-loop="true" data-autoplay="true" data-animate-in="fadeIn" data-animate-out="fadeOut" data-autoplay="2500" data-lightbox="gallery">
                                    @forelse ($product->galleries as $gallery)
                                        <a href="{{ Storage::url($gallery->url) }}" data-lightbox="image" title="{{ $product->name }} product image"><img alt="{{ $product->name }} product image" src="{{ Storage::url($gallery->url) }}">
                                        </a>
                                    @empty
                                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="This Item Not Have Image">
                                    @endforelse
                                </div>
                                {{-- Carousel slider --}}
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="product-description">
                                <div class="product-category">{{ $product->category->name }}</div>
                                <div class="product-category">{{ $product->detail->name }}</div>
                                <div class="product-category">{{ $product->type->name }}</div>
                                <div class="product-title">
                                    <h3 style="margin-right: 20px"><a href="{{ Route('product', $product->slug) }}">{{ $product->name }}</a></h3>
                                </div>
                                @if ($product->is_sold == false)
                                    <div class="product-price"><ins>{{ number_format($product->price) }} Gold</ins>
                                    </div><br>
                                @else
                                    <span class="badge badge-pill badge-danger">SOLD</span>
                                    <div class="product-price"><ins><strike>{{ number_format($product->price) }}</strike> Gold</ins>
                                    </div><br>
                                @endif
                                <div class="product-category">Added {{ $product->created_at->diffForHumans() }}</div>
                                <div class="product-category">Viewed {{ $product_log }} times</div>
                                <div class="seperator m-b-10"></div>
                                    <div class="product-title">
                                        <u><h2>Seller Info</h2></u>
                                        IGN : <h3>{{ $product->user_product->ign }}</h3><br>
                                        Discord ID : <h3>{{ $product->user_product->discord }}</h3>
                                    </div>
                                <div class="seperator m-b-10"></div>
                                    {!! Str::limit($product->description, 500) !!}
                                <div class="seperator m-t-20 m-b-10"></div>
                            </div>
                        </div>
                    </div>
                    {{-- Product additional tabs --}}
                    <div class="tabs tabs-folder">
                        <ul class="nav nav-tabs" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="false"><i class="fa fa-align-justify"></i>Description</a></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="true"><i class="fa fa-info"></i>Item Info</a></a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent3">
                            <div class="tab-pane fade active show" id="home3" role="tabpanel" aria-labelledby="home-tab">
                                {!! $product->description !!}
                            </div>
                            <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Job</td>
                                            <td>{{ $product->job->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Category</td>
                                            <td>{{ $product->category->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Detail / Additional Option</td>
                                            <td>{{ $product->detail->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Type</td>
                                            <td>{{ $product->type->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Value</td>
                                            <td>{{ $product->value }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- end: Product additional tabs --}}
                </div>
                @if ($recommendations->count() >= 1)
                <div class="heading-text heading-line text-center">
                    <h4>You may be also search for this item!</h4>
                </div>
                <div class="row">
                    @foreach ($recommendations as $recommend)
                    <div class="col-lg-4">
                        <div class="widget-shop">
                            <div class="product">
                                <div class="product-image">
                                    <a href="{{ route('product', $recommend->slug) }}"><img src="{{ $recommend->galleries()->exists() ? Storage::url($recommend->galleries->first()->url) : 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==' }}" alt="Shop product image!">
                                    </a>
                                </div>
                                <div class="product-description">
                                    <div class="product-category">{{ $recommend->job->name }}</div>
                                    <div class="product-category">{{ $product->detail->name }}</div>
                                    <div class="product-category">{{ $product->type->name }}</div><br>
                                    <div class="product-title">
                                        <h3><a href="{{ route('product', $recommend->slug) }}">{{ $recommend->name }}</a></h3>
                                    </div>
                                    <div class="product-price" style="width: 100%">{{ number_format($recommend->price) }} Gold
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            {{-- end: Content--}}
            {{-- Sidebar--}}
            <div class="sidebar col-lg-3">
                {{--widget newsletter--}}
                <div class="widget clearfix widget-archive">
                    <h4 class="widget-title">Item categories</h4>
                    <ul class="list list-lines">
                        @foreach ($product_categories as $category)
                            <li>
                                <a href="#">{{ $category->name }}</a> <span class="count">({{ $category->product_count }})</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="widget clearfix widget-shop">
                    <h4 class="widget-title">Latest Item Added</h4>
                    @foreach ($latest_products as $product)
                        <div class="product">
                            <div class="product-image">
                                <a href="{{ route('product', $product->slug) }}"><img src="{{ $product->galleries()->exists() ? Storage::url($product->galleries->first()->url) : 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==' }}" alt="Shop product image!">
                                </a>
                            </div>
                            <div class="product-description">
                                <div class="product-category">{{ $product->job->name }}</div>
                                <div class="product-category">{{ $product->detail->name }}</div>
                                <div class="product-category">{{ $product->type->name }}</div><br>
                                <div class="product-title">
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
