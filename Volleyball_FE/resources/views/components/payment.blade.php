@extends('layouts.master')

@section('title')
    <title>Payment</title>
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
                    <div class="breadcrumbs">
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li class="active">Payment</li>
                        </ol>
                    </div><!--/breadcrums-->

                    <div class="review-payment">
                        <h2>Review & Payment</h2>
                    </div>

                    <div class="table-responsive cart_info">
                        <?php
                        $content = Cart::content();
                        ?>
                        <table class="table table-condensed">
                            <thead>
                            <tr class="cart_menu">
                                <td class="image">Image</td>
                                <td class="description">Name</td>
                                <td class="price">Price</td>
                                <td class="quantity">Quantity</td>
                                <td class="total">Total</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($content as $contentItem)
                                <tr>
                                    <td class="cart_product">
                                        <a href=""><img
                                                src="{{ config('app.base_Url') . $contentItem->options->image }}"
                                                width="80" height="80" alt=""></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a>{{ $contentItem->name }}</a></h4>
                                        <p>Web ID: 1089772</p>
                                    </td>
                                    <td class="cart_price">
                                        <p>${{ $contentItem->price }}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <form action="{{ route('carts.updateCart') }}" method="POST">
                                                @csrf
                                                <input class="cart_quantity_input" type="text"
                                                       name="cart_quantity" value="{{ $contentItem->qty }}">
                                                <input type="hidden" name="rowId_cart" value="{{ $contentItem->rowId }}"
                                                       class="form-control">
                                                <input name="quantity_update" type="submit" value="Update">
                                            </form>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">
                                            <?php
                                            $total = $contentItem->qty * $contentItem->price;
                                            echo '$' . $total;
                                            ?>
                                        </p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete"
                                           href="{{ route('carts.deleteCart',['rowId'=> $contentItem->rowId]) }}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <h4 style="margin: 40px ; font-size: 20px">Choose your payment method</h4>
                    <form action="" method="POST">
                        @csrf
                        <div class="payment-options">
                        <span>
                            <label><input name="momo_payment" type="checkbox" value="1"> Momo</label>
                        </span>

                            <span>
                            <label><input name="cash_payment" type="checkbox" value="2"> Cash</label>
                        </span>
                        </div>
                    </form>
                </div>
            </section> <!--/#cart_items-->

        </div>
    </section>

@endsection
