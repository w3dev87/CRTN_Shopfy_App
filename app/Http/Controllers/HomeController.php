<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Facades\ShopifyService;
use App\Backgrounds;
use App\Background_types;
use App\Order_products;
use App\Order;
use App\Customers;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(empty(Cookie::get('customerInfo'))){
            return redirect(route('login'));
        }

        return redirect(route('dashboard'));
    }

    public function pop_background(){

        if(empty(Cookie::get('customerInfo'))){
            return redirect(route('login'));
        }

        $data['background_type'] = Background_types::all();
        $data['backgrounds']     = Backgrounds::all();
        $data['customer_info']= json_decode(Cookie::get('customerInfo'));

        $order_info = Order::where('order_id',$data['customer_info']->order_id)->first();

        $data['product'] = Order_products::where('order_id',$data['customer_info']->order_id)->first()->toArray();

        if(empty($order_info)){
            return response(view('errors.404'), 404);
        }

        $data['order_info'] = $order_info->toArray();

        $data['customer_info']= Customers::where('email',$order_info['user_email'])->first();

        return view('backgrounds/pop_background',$data);
    }

    public function ax_save_background(Request $request){

        $data['errors'] = [];

        $background_id = $request->background_id;
        $order_id   = $request->order_id;

        if(empty($background_id) || empty($order_id)){
            $data['errors'][] = 'Data not saved Please reload page and try again';
            return json_encode($data);
        }

        $order_info = Order::find($order_id);

        Order::where('id',$order_info['id'])
            ->update(['background_id'=>$background_id,'status'=>2]);

        return json_encode($data);
    }
}
