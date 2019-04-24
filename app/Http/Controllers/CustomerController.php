<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Facades\ShopifyService;
use App\Order;
use App\Order_products;
use App\Va_imageses;
use App\Backgrounds;
use App\Background_types;
class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
    }

    public function customer_dashboard(){

        $data['customer_info'] = json_decode(Cookie::get('customerInfo'));

        $order_info = Order::where('order_id',$data['customer_info']->order_id)->first();

        $data['product'] = [];

        if(empty($order_info)){
            Cookie::queue('customerInfo', '', 0);

            return redirect(route('login'));
        }

        $data['background']     = Backgrounds::find($order_info['background_id']);

        $data['product'] = Order_products::where('order_id',$data['customer_info']->order_id)->first();

        if(!empty($data['product'])){
            $data['product'] =  $data['product']->toArray();
        }

        $data['order_info'] = $order_info->toArray();

        $data['va_images'] = Va_imageses::where('order_id',$order_info['id'])->orderBy('id', 'desc')->first();

        return view('dashboard/main',$data);
    }

    public function customer_logout(){

        Cookie::queue('customerInfo', '', 0);

        return redirect(route('login'));
    }
}