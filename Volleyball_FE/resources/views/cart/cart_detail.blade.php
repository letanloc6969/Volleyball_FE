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
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>

            <div class="table-responsive cart_info">
                <?php
                $content = Cart::content();
                session()->put('cc', $content);
                ?>
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Image</td>
                        <td class="description">Name</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="size">Size</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($content as $contentItem)
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="{{ config('app.base_Url') . $contentItem->options->image }}"
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
                                        <input class="cart_quantity_input" type="number"
                                               name="cart_quantity" value="{{ $contentItem->qty }}">
                                        <input type="hidden" name="rowId_cart" value="{{ $contentItem->rowId }}"
                                               class="form-control">
                                        <input name="quantity_update" type="submit" value="Update">
                                    </form>
                                </div>
                            </td>
                            <td class="cart_size">
                                <p>{{ $contentItem->options->size }}</p>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    <?php
                                    $total = $contentItem->qty * $contentItem->price;
                                    echo '$' . $total;
                                    ?>
                                    {{--                                {{ $contentItem->total }}--}}
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
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="heading">
                <form action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Chọn tỉnh/thành phố</label>
                        <select name="city" id="city" class="form-control choose city">
                            <option>--Chọn tỉnh/thành phố--</option>
                            @foreach($city as $thanhpho)
                                <option
                                    value="{{$thanhpho->matp}}">{{ $thanhpho->name_city }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Chọn quận huyện</label>
                        <select name="province" id="province"
                                class="form-control province choose">
                            <option>--Chọn tỉnh/thành phố--</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Chọn xã phường</label>
                        <select name="wards" id="wards" class="form-control wards">
                            <option>--Chọn tỉnh/thành phố--</option>
                        </select>
                    </div>

                    <input name="calculator_order" type="button"
                           value="Tính phí vận chuyển"
                           class="btn btn-primary calculator_delivery">
                </form>
                <h3>Coupon</h3>
                <form method="POST" action="{{url('/check-coupon')}}">
                    @csrf
                    <input type="text" class="form-control" name="coupon" placeholder="Enter coupon"><br>
                    <input type="submit" class="btn btn-default check_coupon" name="check coupon" value="Check coupon">
                    @if(Session::get('coupon'))
                        <a type="submit" class="btn btn-default check_out" name="unset coupon"
                           href="{{'/unset-coupon'}}"> Delete Coupon</a>
                    @endif
                </form>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>
                                                     ${{Cart::subtotalFloat()}}
                                                </span></li>
                            <li>Eco Tax <span>

                                    ${{Cart::subtotalFloat()*0.1}}
                                        </span></li>
                            <li>Shipping Cost
                                <span>
                                    @if(isset($total))
                                        @if(null!==Session::get('fee'))
                                            <a class="cart_quantity_delete" href="{{route('delivery.delete.fee')}}"><i
                                                    class="fa fa-times"></i></a>
                                            <span>$@php $abc=Session::get('fee');

                                                @endphp {{$abc}}
                                            </span>

                                            {{--                                            @foreach(Session::get('fee') as $fee)--}}
                                            {{--                                                ${{$fee['fee_feeship']}}--}}
                                            {{--                                                <p>--}}
                                            {{--                                                                                        @php--}}
                                            {{--                                                                                            $total_feeship =  $total+ $fee['fee_feeship'];--}}
                                            {{--                                                                                        @endphp--}}
                                            {{--                                                                                        </p>--}}
                                            {{--                                            @endforeach--}}
                                        @else
                                            <a>$0</a>
                                        @endif
                                        @endif
                                </span>
                            </li>
                            <li>Coupon <span>
                            @if(isset($total))
                                        @if(null!==Session::get('coupon'))
                                            @foreach(Session::get('coupon') as $key => $cou)
                                                ${{$cou['coupon_number']}}
                                                <p>
                                    @php

                                        $total_coupon =  Cart::subtotalFloat()- $cou['coupon_number'];
                                    @endphp
                                </p>

                            <li>Total <span> @if(isset($total))
                                        @if(isset($abc))
                                        @php
                                            $endtotal=$abc+$total_coupon+Cart::subtotalFloat()*0.1;
                                        @endphp
                                            ${{$endtotal}}
                                        @else

                                            @php
                                                $endtotal=$total_coupon+Cart::subtotalFloat()*0.1;
                                            @endphp
                                        ${{$endtotal}}
                                            @endif
                                    @endif </span></li>
                            @endforeach
                            @else
                                <a>0</a>
                                <li>Total <span> @if(isset($total))
                                            @if(isset($abc))
                                            @php
                                                $endtotal=$abc+Cart::subtotalFloat()+Cart::subtotalFloat()*0.1;
                                            @endphp
                                            @else
                                                @php
                                                    $endtotal=Cart::subtotalFloat()+Cart::subtotalFloat()*0.1;
                                                @endphp
                                            @endif
                                            ${{$endtotal}}
                                        @endif </span></li>
                                @endif
                                </span></li>
                            @endif
                        </ul>

                        @if(Auth::check())
                            <a class="btn btn-default check_out" href="{{ route('customers.checkout') }}">Check Out</a>
                        @else
                            <a class="btn btn-default check_out" href="{{ route('customers.login') }}">Check Out</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
@endsection
<body>
</body>
</html>


