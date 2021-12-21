@extends('layouts.master')

@section('title')
    <title>Show Cart</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('home/home.css') }}">
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('home/home.js') }}"></script>
@endsection

@section('content')
    <section>
        <div class="card_wrapper">
            @include('components.cart_component')
        </div>
    </section>

@endsection

<body>


</body>
</html>



