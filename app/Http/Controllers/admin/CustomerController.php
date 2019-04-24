<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Customers;
use App\Approve;
class CustomerController extends Controller
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

    public function all_customer(){

        $data['customer_info'] = Customers::with('customer_img')->get();

        if(!empty($data['customer_info'])){
            $data['customer_info'] = $data['customer_info']->toArray();
        }

        return view('admin/customer/all_customer',$data);
    }

}