<div class="cart_component" data-url="{{ route('products.deleteCart') }}">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Cart Items</h2>

                    <table class="table update_cart_url" data-url="{{ route('products.updateCart') }}">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ảnh sản phẩm</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @php
                            $total=0;
                        @endphp
                        @foreach($carts as $id => $cartItem)
                            @php
                                $total += $cartItem['price'] *  $cartItem['quantity']
                            @endphp

                            <tr>
                                <th scope="row">{{ $id }}</th>
                                <td>
                                    <img src="{{config('app.base_Url') . $cartItem['image'] }}">
                                </td>
                                <td>{{ $cartItem['name'] }}</td>
                                <td>{{ number_format($cartItem['price']) }}</td>
                                <td>
                                    <input type="number" class="quantity"
                                           value="{{ $cartItem['quantity'] }}" min="1">
                                </td>
                                <td>
                                    {{number_format($cartItem['price'] *  $cartItem['quantity']) }}
                                </td>
                                <td>
                                    <a href="" data-id="{{ $id }}"
                                       class="btn btn-default cart_update ">Cập nhật</a>
                                    <a data-id="{{ $id }}"
                                       class="btn btn-danger cart_delete">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        <h2>Tổng tiền : ${{ number_format($total) }}</h2>
                    </div>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</div>
