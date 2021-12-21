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
    <!--/slider-->
    @include('home.components.slider')
    <!--/slider-->

    <section>
        <div class="container">
            <div class="row">

                @include('components.sidebar')

                <div class="col-sm-9 padding-right">

                    <!--features_items-->
                    @include('home.components.feature_product')
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
