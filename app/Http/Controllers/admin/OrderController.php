<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Order;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use App\Va_imageses;
use Illuminate\Support\Facades\Mail;
use App\Order_note;
class OrderController extends Controller
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

    public function all_order(){

        $data['orders'] = Order::with('products', 'background', 'notes', 'artwork')->get();

        return view('admin/orders/order_main',$data);
    }

    public function upload_image($id){
        $data['id'] = $id;
        return view('admin/orders/upload_image',$data);
    }

    public function ax_upload_file(Request $request){

        $image = $request->file('file');
        $id = $request->id;

        $image_name = Str::random(8).$image->getClientOriginalName();

        $image_path = public_path('images/'.$id);

        $order = Order::select()->where('id',$id)->first();

        $order_images = Va_imageses::select()->where('order_id',$id)->first();

        $FileSystem = new Filesystem();

        if($FileSystem->exists($image_path) && !empty($order_images) ){

            $order_images = $order_images->toArray();

            @unlink($image_path.'/'.$order_images['image']);
        }

        $upload_success = $image->move($image_path,$image_name);

        if ($upload_success) {

            $data['inf'] = $image_name;

            $hash = encrypt($order['user_email'].$order['order_number'].$order['id']);

            $order_data = array('order_number'=>$order['order_number'],'hash'=>$hash);
            Mail::send('emails.va_upload_email', $order_data, function($message) use ($order) {
                $message->to(env('TEST_SEND_EMAIL'))->subject('CRTN.ME Order Update! [#'.$order['order_number'].']');
            });

            if(!$order_images){

                $insert_data = [
                    'image'=>$image_name,
                    'order_id'=>$id,
                ];

                Va_imageses::insert($insert_data);
                return json_encode($data);
            }

            Va_imageses::where('order_id',$id)
                ->update(['image'=>$image_name]);

            Order::where('id',$id)
                ->update(['status'=>3]);

            return json_encode($data);
        }
        // Else, return error 400
        else {
            return response()->json('error', 400);
        }
    }

    public function order_notes(){

        $data['order_notes'] = Order_note::with('order_note')->get();

        return view('admin/orders/order_notes',$data);
    }

    private function encrypt($text) {

        $text = sha1($text);

        return $text;
    }

}