<?php
/**
 * Created by PhpStorm.
 * User: Gev
 * Date: 3/23/19
 * Time: 2:54 PM
 */

namespace App\Services;

class Shopify {

    private $response = [
            'status'  => 1,
            'errors'  => [],
            'warning' => [],
            'data'    => []
        ];

    public function order($order_id){

        $response = $this->init_response();

        if(empty($order_id)){

            $response['status'] = 0;
            $response['errors'][] = 'Undefined order.';
            return $response;
        }

        $order_id = intval($order_id);

        if($order_id <= 0){

            $response['status'] = 0;
            $response['errors'][] = 'Undefined order.';
            return $response;
        }

        $url = "orders/$order_id.json";

        $res = $this->curl($url);

        if($res['errno'] != 0){

            $response['status'] = 0;
            $response['errors'][] = 'Can not get order information.';
            return $response;
        }

        $content = @json_decode($res['content']);

        if(empty($content)){

            $response['status'] = 0;
            $response['errors'][] = 'Can not get order information.';
            return $response;
        }

        if(!isset($content->order)){

            $response['status'] = 0;
            $response['errors'][] = 'Can not get order information.';
            return $response;
        }

        $order = $content->order;

        $items = $order->line_items;

        $return_data = [
            'id'           => $order->id,
            'email'        => $order->email,
            'name'         => $order->name,
            'created_at'   => $order->created_at,
            'updated_at'   => $order->updated_at,
            'checkout_id'  => $order->checkout_id,
            'status'       => $order->financial_status,
            'tracking_url' => $order->order_status_url,
            'products'     => [],
        ];

        if(empty($items)){

            $response['status'] = 0;
            $response['errors'][] = 'No items for this order.';
            return $response;
        }

        // can be in loop ----------------
        $temp_arr = [];
        $item = $items[0];
        $product_info = $this->product($item->product_id);

        if($product_info['status'] == 0){
            return $product_info;
        }

        $temp_arr['product'] = $product_info['data'];
        $temp_arr['user_image'] = false;

        if(!empty($item->properties)){
            $img_url = $this->get_image_from_properties($item->properties);
        }

        if(!empty($img_url)){
            $temp_arr['user_image'] = $img_url;
        }

        $return_data['products'][] = $temp_arr;
        // ----------------------------

        /*$transaction_info = $this->order_transaction($order->id);*/

        $response['data'] = $return_data;

        return $response;

    }

    public function order_by_num($order_num){

        $response = $this->init_response();

        if(empty($order_num)){

            $response['status'] = 0;
            $response['errors'][] = 'Undefined order.';
            return $response;
        }

        $order_num = intval($order_num);

        if($order_num <= 0){

            $response['status'] = 0;
            $response['errors'][] = 'Undefined order.';
            return $response;
        }

        $url = "orders.json?name=$order_num";

        $curl_response = $this->curl($url);

        if($curl_response['errno'] != 0){

            $response['status'] = 0;
            $response['errors'][] = 'Can not get order information.';
            return $response;
        }

        $content = @json_decode($curl_response['content']);

        if(empty($content)){

            $response['status'] = 0;
            $response['errors'][] = 'Can not get order information.';
            return $response;
        }

        if(!isset($content->orders)){

            $response['status'] = 0;
            $response['errors'][] = 'Can not get order information.';
            return $response;
        }

        $order = $content->orders;

        if(empty($order)){

            $response['status'] = 0;
            $response['errors'][] = 'Order not found.';
            return $response;
        }

        $order = $order[0];

        $items = $order->line_items;

        $customer = $order->customer;

        if(!empty($customer)){
            $customer = (array) $customer;
            if(!empty($customer['default_address'])){
                $customer['default_address'] = (array) $customer['default_address'];
            }
        }

        $return_data = [
            'id'           => $order->id,
            'email'        => $order->email,
            'name'         => $order->name,
            'customer'     => $customer,
            'created_at'   => $order->created_at,
            'updated_at'   => $order->updated_at,
            'checkout_id'  => $order->checkout_id,
            'status'       => $order->financial_status,
            'tracking_url' => $order->order_status_url,
            'order_number' => $order->order_number,
            'products'     => [],
        ];

        if(empty($items)){

            $response['status'] = 0;
            $response['errors'][] = 'No items for this order.';
            return $response;
        }

        // can be in loop ----------------
        $temp_arr = [];
        $item = $items[0];
        $product_info = $this->product($item->product_id);

        if($product_info['status'] == 0){
            return $product_info;
        }

        $temp_arr['product'] = $product_info['data'];
        $temp_arr['user_image'] = false;

        if(!empty($item->properties)){
            $img_url = $this->get_image_from_properties($item->properties);
        }

        if(!empty($img_url)){
            $temp_arr['user_image'] = $img_url;
        }

        $return_data['products'][] = $temp_arr;
        // ----------------------------

        /*$transaction_info = $this->order_transaction($order->id);*/

        $response['data'] = $return_data;

        return $response;

    }

    public function order_transaction($order_id){

        $response = $this->init_response();

        if(empty($order_id)){

            $response['status'] = 0;
            $response['errors'][] = 'Undefined order.';
            return $response;
        }

        $url = "orders/$order_id/transactions.json";

        $res = $this->curl($url);

        $res = @json_decode($res['content'], true);

        if(empty($res['transactions'])){

            $response['status'] = 0;
            $response['errors'][] = 'Can not get transaction info.';
            return $response;
        }

        if(empty($res['transactions'][0])){

            $response['status'] = 0;
            $response['errors'][] = 'Can not get transaction info.';
            return $response;
        }

        $response['data'] = $res['transactions'][0];

        return $response;
    }

    public function product($product_id){

        $response = $this->init_response();

        if(empty($product_id)){

            $response['status'] = 0;
            $response['errors'][] = 'Undefined product.';
            return $response;
        }

        $product_id = intval($product_id);

        if($product_id <= 0){

            $response['status'] = 0;
            $response['errors'][] = 'Undefined product.';
            return $response;
        }

        $url = "products/{$product_id}.json";

        $curl_res = $this->curl($url);

        $content = @json_decode($curl_res['content']);

        if(empty($content)){

            $response['status'] = 0;
            $response['errors'][] = 'Can not get product information.';
            return $response;
        }

        if(empty($content->product)){

            $response['status'] = 0;
            $response['errors'][] = 'Can not get product information.';
            return $response;
        }

        $product = $content->product;

        $return_data = [
            'id'    => $product->id,
            'name'  => $product->title,
            'image' => false,
        ];

        if(!empty($product->image->src)){
            $return_data['image'] = $product->image->src;
        }

        $response['data'] = $return_data ;

        return $response;

    }

    private function get_image_from_properties($properties){

        if(empty($properties)){
            return false;
        }

        $img_url = NULL;

        foreach($properties as $single){
            if(stripos($single->name, 'Photo') !== FALSE){
                $img_url = $single->value;
            }
        }

        $parts = parse_url($img_url);
        parse_str($parts['query'], $query);

        if(empty($query['id']) || empty($query['uu']) || empty($query['fi'])){
            return false;
        }

        $query['fi'] = base64_decode($query['fi']);

        $url = "https://files.getuploadkit.com/".$query['id']."/".$query['uu']."/".$query['fi']."?dl=1";

        return $url;
    }

    private function curl($url, $auth = true){

        if(empty($url)){
            return false;
        }

        if($auth){
            $url = 'https://'.env("SHOPIFY_API_KEY").':'.env("SHOPIFY_API_PASSWORD").env("SHOPIFY_API_hostname").'/admin/'.$url;
        }

        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => "spider", // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 5,        // timeout on connect
            CURLOPT_TIMEOUT        => 5,        // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );

        $response  = curl_getinfo( $ch );

        curl_close( $ch );

        $response['errno']   = $err;
        $response['errmsg']  = $errmsg;
        $response['content'] = $content;

        return $response;

    }

    private function init_response(){
        return $this->response;
    }

}