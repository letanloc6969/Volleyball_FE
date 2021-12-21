<?php

namespace App\Http\Controllers;

use App\Category;
use App\Feeship;
use App\Order;
use App\OrderProduct;
use App\Province;
use App\Ward;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
class CheckoutController extends Controller
{
    public function loginCheckout()
    {
        $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
        return view('checkout.login_checkout', compact('categoriesLimit'));
    }

    public function saveCheckout(Request $request)
    {
        $request->validate([
            'order_email' => 'required|email',
            'order_name' => 'required|min:6|max:32',
            'order_phone' => 'required|min:8|max:11',
            'order_address' => 'required'
        ], [
            'order_email.required' => 'Bạn chưa nhập Email',
            'order_email.email' => 'Email chưa đúng định dạng',
            'order_name.required' => 'Bạn chưa nhập Họ tên',
            'order_phone.required' => 'Bạn chưa nhập Số điện thoại',
            'order_phone.min' => 'Số điện thoại phải có ít nhất 8 ký tự',
            'order_phone.max' => 'Số điện thoại không được quá 11 ký tự',
            'order_address.required' => 'Bạn chưa nhập địa chỉ'
        ]);

        try {
            DB::beginTransaction();
            $a = Order::create([
                'name' => $request->order_name,
                'email' => $request->order_email,
                'address' => $request->order_address,
                'phone' => $request->order_phone,
                'note' => $request->order_note,
                'payments' => $request->payment_option,
                'total' => $request->order_total,
                'status' => 0,
                'user_id' => auth()->id()
            ]);

            $content = $request->session()->get('cc');
            foreach ($content as $contenItem) {
                OrderProduct::create([
                    'order_id' => $a->id,
                    'productsize_id' => $contenItem->options->productSize,
                    'quantity' => $contenItem->qty
             ]);
            }
            \Cart::destroy();
            DB::commit();

            return redirect()->route('thankyou');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('thongbao_2', 'Đặt hàng thất bại! Hãy kiểm tra lại thông tin đặt hàng');
        }
    }

    public function payment()
    {
        $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
        return view('components.payment', compact('categoriesLimit'));
    }

    public function postPayment(Request $request)
    {

    }

    public function select_Delivery(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'city') {
                $select_province = Province::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                foreach ($select_province as $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {
                $select_wards = Ward::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                foreach ($select_wards as $wards) {
                    $output .= '<option value="' . $wards->xaid . '">' . $wards->name_xaphuong . '</option>';
                }
            }
        }
        echo $output;
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
