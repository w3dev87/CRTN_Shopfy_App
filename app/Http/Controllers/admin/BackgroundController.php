<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Background_types;
use Illuminate\Support\Str;
use App\Backgrounds;
use App\Order;
use App\Order_products;
use App\Approve;
class BackgroundController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
         $this->middleware('auth:admin');
    }

    public function add_background_type(){

        return view('admin/backgrounds/background_type');
    }

    public function ax_add_background_cat(Request $request){

        $cat_name = $request->name;

        $data['errors'] = [];

        if(empty($cat_name)){
            $data['errors'][] = 'Please set category name';
            return json_encode($data);
        }

        Background_types::insert(['type_name'=>$cat_name]);

        return json_encode($data);
    }

    public function add_background(){

        $data['back_cat'] = Background_types::All();

        if(!empty($data['back_cat'])){
            $data['back_cat'] = $data['back_cat']->toArray();
        }

        return view('admin/backgrounds/add_background',$data);
    }

    public function ax_add_background(Request $request){

        $data['errors'] = [];

        $background_cat = $request->background_cat;

        if(empty($background_cat)){
            $data['errors'][] = 'Please set category';
            return json_encode($data);
        }

        $image = $request->file('file');

        $image_name = Str::random(8).$image->getClientOriginalName();

        $image_path = public_path('/backgrounds/');

        if(!is_dir($image_path)){
            mkdir($image_path );
        }

        $upload_success = $image->move($image_path,$image_name);

        if ($upload_success) {

            $data['inf'] = $image_name;

            $insert_data = [
                'image'=>$image_name,
                'type_id'=>$background_cat,
            ];

            Backgrounds::insert($insert_data);

            return json_encode($data);
        }
        // Else, return error 400
        else {
            return response()->json('error', 400);
        }

    }

    public function change_background($customer_id){

        $data['customer_info']= json_decode(Cookie::get('customerInfo'));

        $data['background_type'] = Background_types::all();
        $data['backgrounds']     = Backgrounds::all();

        $order_info = Order::where('order_id',$data['customer_info']->order_id)->first();

        $data['product'] = Order_products::where('order_id',$data['customer_info']->order_id)->first()->toArray();

        $data['customer_id'] = $customer_id;

        if(empty($order_info)){
            return response(view('errors.404'), 404);
        }

        $data['order_info'] = $order_info->toArray();

        return view('admin/backgrounds/change_background',$data);
    }

    public function all_background(){

    }

}