<?php

namespace App\Http\Controllers;

use App\City;
use App\Coupon;
use App\Feeship;
use App\ProductSize;
use App\Size;
use Cart;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
session_start();

class CartController extends Controller
{
    public function saveCart(Request $request)
    {
        $products = $request->product_id;
        $quantity = $request->quantity;
        $size_product = $request->size;
        $size_value = Size::where('id',$size_product)->first();
        $size_id = ProductSize::where(['size_id' =>$size_product,
            'product_id'=> $products])->first();

        $product_info = Product::where('id',$products)->first();

        $data['id'] = $product_info->id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->name;
        $data['price'] = $product_info->price;
        $data['weight'] = $product_info->price;
        $data['options']['image'] = $product_info->feature_image_path;
        $data['options']['size'] = $size_value->size;
        $data['options']['productSize'] = $size_id->id;

//        $data['total'] = $quantity * $product_info->price;
        Cart::Add($data);
        Cart::setGlobalTax(5);
        return redirect()->to('/show-cart');
    }

    public function showCart()
    {
        $city = City::orderby('matp','ASC')->get();

        $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
        return view('cart.cart_detail',compact('categoriesLimit','city'));
    }

    public function deleteCart($rowId)
    {
        Cart::update($rowId,0);
        return redirect()->to('/show-cart');
    }

    public function updateCart(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return redirect()->to('/show-cart');
    }

    public function check_coupon(Request $request)
    {
        $data = $request->all();
        $coupon= Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon)
        {
            $count_coupon = $coupon->count();
            if($count_coupon>0)
            {
                $coupon_session = Session::get('coupon');
                if($coupon_session==true)
                {
                    $is_available = 0;
                    if($is_available==0)
                    {
                        $cou[] = array(
                            'coupon_code'=>$coupon->coupon_code,
                            'coupon_number'=>$coupon->coupon_number,
                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                        'coupon_code'=>$coupon->coupon_code,
                        'coupon_number'=>$coupon->coupon_number,
                    );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã thành công');
            }
        }else{
            return redirect()->back()->with('error','Thêm mã không thành công');
        }
    }
    public function unset_coupon()
    {
        $coupon = Session::get('coupon');
        if($coupon==true)
        {
            Session::forget('coupon');
            return redirect()->back()->with('message','Đã xóa mã');
        }
    }

    public function delivery_Fee(Request $request)
    {
        $data = $request->all();
        if ($data['matp']){
            $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            foreach ($feeship as $fee){
                Session::put('fee',$fee->fee_feeship);
                Session::save();
            }
        }
    }

    public function delivery_Delete_Fee(){
        Session::forget('fee');
        return redirect()->back();
    }
}
