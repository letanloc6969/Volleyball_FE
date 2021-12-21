@extends('layouts.master')

@section('title')
    <title>Home Page</title>
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

                    <!--features_items-->
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Result Product Items</h2>

                        @foreach($search_product as $product)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ config('app.base_Url') . $product->feature_image_path }}" alt=""/>
                                            <h2>${{$product->price}}</h2>
                                            <p>{{ $product->name }}</p>
                                            <a href="#" data-url=""
                                               class="btn btn-primary add-to-cart">
                                                <i class="fa fa-shopping-cart"></i>Add to cart
                                            </a>
                                        </div>

                                        <a href="{{ route('products.detail',['id'=>$product->id])}}">
                                            <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <h2>${{$product->price}}</h2>
                                                    <p>{{ $product->name }}</p>
                                                    <a class="btn btn-primary add-to-cart"
                                                       data-url="">
                                                        <i class="fa fa-shopping-cart"></i>
                                                        Add to cart
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div><!--features_items-->

                    <!--features_items-->

                    <!--/category-tab-->
                @include('home.components.category_tab')
                <!--/category-tab-->

                    <!--recommended_items-->
                @include('home.components.recommend_product')
                <!--recommended_items-->

                </div>
            </div>
        </div>
    </section>
@endsection

<body>


</body>
</html>
