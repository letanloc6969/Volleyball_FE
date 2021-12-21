@extends('layouts.master')

@section('title')
    <title>Thank you</title>
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
            <section id="cart_items">
                <div class="container">
                    <h4>Cảm ơn quý khách đã mua hàng tại Shop</h4>
                    <br>
                    <h4>Nhấn <a href="{{route('home')}}">vào đây</a> để trở lại trang chủ</h4>
                </div>
            </section> <!--/#cart_items-->

        </div>
    </section>

@endsection
