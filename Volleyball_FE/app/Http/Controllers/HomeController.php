<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\Product;
use App\Slider;
use App\User;
use App\City;
use App\Province;
use App\Ward;
use App\Feeship;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
session_start();
class HomeController extends Controller
{
    private $slider;
    public function __construct(Slider $slider )
    {
        $this->slider = $slider;
    }
    public function index()
    {
        $sliders = $this->slider->latest()->get();
        $categories = Category::where('parent_id', 0)->get();
        $products = Product::Latest()->take(6)->get();
        $productsRecommend = Product::Latest('views_count','desc')->take(12)->get();
        $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
        return view('home.home' , compact('sliders','categories', 'products', 'productsRecommend','categoriesLimit'));
    }


    public function checkout()
    {
        $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
        $city = City::orderby('matp','ASC')->get();
        return view('components.checkout',compact('categoriesLimit','city'));
    }

    public function loginCustomer()
    {
        $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
        return view('components.login',compact('categoriesLimit'));
    }

    public function postLoginCustomer(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:32'

        ],[
            'email.required'=>'Bạn chưa nhập Email',
            'email.email'=> 'Email chưa đúng định dạng',
            'password.required'=>'Bạn chưa nhập Password',
            'password.min'=>'Password phải có ít nhất 6 ký tự',
            'password.max'=>'Password không quá 32 ký tự'
        ]);

        $remember = $request->has('remember_me') ? true : false;

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember)) {
            return redirect()->route('customers.checkout');
        }else{
            return redirect()->back()->with('thongbao','Đăng nhập thất bại! Hãy kiểm tra lại thông tin đăng nhập');
        }
    }

    public function logoutCustomer()
    {
        Auth::logout();
        return redirect()->to('/');
    }

    public function postRegistertCustomer(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:32',
            'phone'=> 'required|min:8|max:11'
        ],[
            'email.required'=>'Bạn chưa nhập Email',
            'email.email'=> 'Email chưa đúng định dạng',
            'password.required'=>'Bạn chưa nhập Password',
            'password.min'=>'Password phải có ít nhất 6 ký tự',
            'password.max'=>'Password không quá 32 ký tự',
            'phone.required'=>'Bạn chưa nhập Số điện thoại',
            'phone.min'=>'Số điện thoại phải có ít nhất 8 ký tự',
            'phone.max'=>'Số điện thoại không được quá 11 ký tự',
        ]);

        try{
            DB::beginTransaction();

            $customer = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone'=> $request->phone,
                'address'=> $request->address
            ]);

            $customer->roles()->attach(2);
            DB::commit();
            return redirect()->route('customers.login');
        }catch (\Exception $exception)
        {
            DB::rollBack();
            return redirect()->back()->with('thongbao_1','Đăng ký thất bại! Hãy kiểm tra lại thông tin đăng ký');
        }


//        $data = array();
//        $data['name'] = $request->name;
//        $data['email'] = $request->email;
//        $data['password'] = $request->password;
//        $data['phone'] = $request->phone;
//
//        $insert = Customer::insertGetId($data);
//
//        \Session::put('id',$insert->id);
//        \Session::put('name',$insert->name);
////        $request->session()->put('id',$insert->id);
////        $request->session()->put('name',$insert->name);
//        return redirect()->route('products.showCart');

    }

    public function thankyou()
    {
        $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
        return view('thankyou',compact('categoriesLimit'));
    }
}
