@extends('layouts.master')

@section('title')
    <title>Product Detail</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('home/home.css') }}">

@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('home/home.js') }}"></script>
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('components.sidebar')

                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="{{ config('app.base_Url') . $products->feature_image_path }}" alt=""/>
                                <h3>ZOOM</h3>
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->

                                <div class="carousel-inner">
                                    @foreach($products->images as $key => $productImageDetailItem)
                                        @if($key %3 == 0)
                                            <div class="item {{ $key == 0 ? 'active' : ''}}">
                                                @endif
                                                <a>
                                                    <img class="image_detail_85_84"
                                                         src="{{ config('app.base_Url') . $productImageDetailItem->image_path}}">
                                                </a>

                                                @if($key %3 == 2)
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Controls -->
                                <a class="left item-control" href="#similar-product" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right item-control" href="#similar-product" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <h2>{{ $products->name }}</h2>
                                <p>Web ID: 1089772</p>

                                <form action="{{ route('products.saveCart') }}" method="POST">
                                    @csrf
                                    <span>
                                        <span>${{ $products->price }}</span>
                                        <label>Quantity: </label>
                                        <input name="quantity" type="number" min="1" value="1">
                                        <input name="product_id" type="hidden" value="{{ $products->id }}">
                                        <button type="submit" class="btn btn-primary add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </button>
                                    </span>
                                    <p>Size: </p>
                                    @foreach($products->productSize as $sizeItem)
                                        <label>
                                            <input name="size" type="radio" value="{{ $sizeItem->id }}" checked>{{ $sizeItem->size }}
                                        </label>
                                    @endforeach
                                </form>
                                <p><b>Availability:</b> In Stock</p>
                                <p><b>Condition:</b> New</p>
                                <p><b>Brand:</b> E-SHOPPER</p>
                                <fieldset>
                                    <legend>Tags</legend>
                                    @foreach($products->tags as $productTag)
                                    <p><i class="fa fa-tag">
                                            @php
                                            $tags = $productTag->name;
                                            $tags = explode(",",$tags);

                                           @endphp
                                            @foreach($tags as $tagItem)
                                                <a href="{{ url('/tags/' .Str::slug($tagItem)) }}"
{{--                                                {{ route('products.tag',['tag_name'=>$productTag->name]) }}--}}
                                                     class="tag_style">{{ $tagItem }}</a>
                                            @endforeach
                                        </i>
                                    </p>
                                    @endforeach
                                </fieldset>

                            </div><!--/product-information-->
                        </div>
                    </div><!--/product-details-->


                    @include('home.components.recommend_product')

                </div>

            </div>
        </div>
    </section>

@endsection

<body>


</body>
</html>


