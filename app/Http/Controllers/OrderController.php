<?php


namespace App\Http\Controllers;

use App\Customers;
use App\Order_note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Facades\ShopifyService;
use App\Backgrounds;
use App\Background_types;
use App\Order_products;
use App\Order;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (empty(Cookie::get('customerInfo'))) {
            return redirect(route('login'));
        }
    }

    public function ax_fix_request(Request $request){

        $msg = $request->msg;
        $order_id = $request->order_id;

        $order = Order::where('id',$order_id)->first();

        $data['errors'] = '';

        if(empty($order_id)){
            $data['errors'][] = 'Data not saved. Please reload page and try again';
            return json_encode($data);
        }

        $customer_info = Customers::where(['email'=>$order['user_email']])->first();

        $insert_data = [
            'order_id'     => $order_id,
            'note'         => $msg,
            'author_name'  => $customer_info['first_name'].' '.$customer_info['last_name'],
            'author_email' => $order['user_email'],
            'created_at'   => date("Y-m-d H:i:s")
        ];

        Order_note::insert($insert_data);

        Order::where('id',$order_id)
            ->update(['status'=>2]);

        return json_encode($data);
    }

    public function apply_order(Request $request){

        $order_id = $request->order_id;

        $order =Order::find($order_id);

        $data['errors'] = '';

        if(empty($order)){
            $data['errors'][] = 'Order not changed. Please reload page and try again';
            return json_encode($data);
        }

        Order::where('id',$order_id)
            ->update(['status'=>4]);

        return json_encode($data);
    }
}
