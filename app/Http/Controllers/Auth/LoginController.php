<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\DB;
use App\Facades\ShopifyService;
use App\Order;
use App\Order_products;
use App\Customers;
use Illuminate\Support\Str;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }

    public function shopifyLogin(){

        if(!empty(Cookie::get('customerInfo'))){
            return redirect(route('dashboard'));
        }

    }

    public function ax_check_login(Request $request){

        $email = $request->email;
        $order_number = $request->order_number;

        $data['errors'] = [];

        $order_count = Order::where(['order_number'=>$order_number,'user_email'=>$email])->count();

        if(!$order_count){

            $order_info = ShopifyService::order_by_num($order_number);

            if($order_info['status'] != 1){
                $data['errors'][] = "Email or Order No. is incorrect, Please try again. 1";
                return json_encode($data);
            }

            if($order_info['data']['email'] != $email){
                $data['errors'][] = "Email or Order No. is incorrect, Please try again. 2";
                return json_encode($data);
            }

            if($order_info['data']['order_number'] != $order_number){
                $data['errors'][] = "Email or Order No. is incorrect, Please try again. 3";
                return json_encode($data);
            }

            $insert_arr = [
                'order_number'   => $order_number,
                'user_email'     => $order_info['data']['email'],
                'shopify_status' => $order_info['data']['status'],
                'order_id'       => $order_info['data']['id'],
                'price'          => $order_info['data']['customer']['total_spent']
            ];

            Order::insert($insert_arr);
            $id = DB::getPdo()->lastInsertId();

            if(!is_dir(public_path('/images'))){
                mkdir(public_path('/images') );
            }

            if(!is_dir(public_path('/images/'.$id))){
                mkdir(public_path('/images/'.$id) );
            }

            if(!is_dir(public_path('/images/'.$id.'/product_image'))){
                mkdir(public_path('/images/'.$id.'/product_image'));
            }

            $path = public_path('/images/'.$id.'/product_image');

            foreach ($order_info['data']['products'] as $single){

               $product_image =  Str::random(8).'.jpg';

               if (!@copy($single['product']['image'], $path.'/'.$product_image)) {

                   $responce = @file_get_contents($single['product']['image']);

                   if(empty($responce) || !file_put_contents($path.'/'.$product_image, $responce)){
                       $product_image = '';
                   }
               }

               $product_insert = [
                   'order_id'      => $order_info['data']['id'],
                   'product_id'    => $single['product']['id'],
                   'product_name'  => $single['product']['name'],
                   'user_image'    => $single['user_image'],
                   'product_image' => $product_image,
               ];

               Order_products::insert($product_insert);
           }

           $customer_count = Customers::where(['email'=>$order_info['data']['email']])->count();

           if(!$customer_count){

               $customer_insert_array = [
                   'first_name'    => $order_info['data']['customer']['first_name'],
                   'last_name'     => $order_info['data']['customer']['last_name'],
                   'address'       => $order_info['data']['customer']['default_address']['address1'],
                   'city'          => $order_info['data']['customer']['default_address']['city'],
                   'country'       => $order_info['data']['customer']['default_address']['country'],
                   'email'         => $order_info['data']['email']
               ];

               Customers::insert($customer_insert_array);
           }

           $customer_info = [
                'first_name' => $order_info['data']['customer']['first_name'],
                'last_name'  => $order_info['data']['customer']['last_name'],
                'address'    => $order_info['data']['customer']['default_address']['address1'],
                'city'       => $order_info['data']['customer']['default_address']['city'],
                'country'    => $order_info['data']['customer']['default_address']['country'],
                'order_id'   => $order_info['data']['id']
           ];

        }else{

            $customer_info = Customers::where(['email'=>$email])->first();
            $order_info = Order::where(['order_number'=>$order_number,'user_email'=>$email])->first();

            $customer_info = [
                'first_name' => $customer_info['first_name'],
                'last_name'  => $customer_info['last_name'],
                'address'    => $customer_info['address'],
                'city'       => $customer_info['city'],
                'country'    => $customer_info['country'],
                'order_id'   => $order_info['order_id']
            ];
        }

        $customer_info = json_encode($customer_info);

        return response(json_encode($data,JSON_HEX_APOS | JSON_HEX_QUOT))->cookie('customerInfo', $customer_info, 3600,null);

    }
}
