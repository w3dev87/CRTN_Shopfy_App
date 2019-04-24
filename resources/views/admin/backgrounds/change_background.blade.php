<?php
$status_arr = [
    '1' =>'Processing',
    '2' =>'Approved',
];
?>

@extends('admin.layouts.admin')

@section('content')

    <div class="container dashboard text-center mt-0">

        <div class="main card">
            <div class="form-group background">
                @if(!empty($backgrounds))
                    @foreach($backgrounds as $single)
                        <div data-id="{{$single['id']}}" class="single_image type_{{$single['type_id']}}"><img  src="{{asset('backgrounds/'.$single['image'])}}" alt=""></div>
                    @endforeach
                @endif

            </div>
            <div class="form-group background_type">
                <select name="" class="form-control " id="background_type">
                    <option value="">All type</option>
                    @if(!empty($background_type))
                        @foreach($background_type as $single)
                            <option value="{{$single['id']}}">{{$single['type_name']}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="card" style="width:50%;margin: 0 auto">
            <h2 class="prod_title"> Order Overview</h2>
            <h5>{{$status_arr[$order_info['status']]}}</h5>
            <P>Order  # {{$order_info['order_number']}}</P>
            {{-- <div class="container mt-1 p-0 main_pr">
                 <div class="productImg">
                     <img src="{{asset('images/'.$order_info['id'].'/product_image/'.$product['product_image'])}}" class="productImage" alt="...">
                 </div>

             </div>--}}
            <div class="product_overvie_cont">
                {{-- User upload card --}}
                <div class="backg_main" data-customer="{{$customer_id}}">
                    <div class="maket" >
                        <img src="{{$product['user_image']}}" class="card-img-top" alt="...">
                        {{--  <div class="card-body">
                              <p class="card-text">Title</p>
                          </div>--}}
                    </div>
                </div>
            </div>
            <div class="product_overvie_cont ">
                <button type="button" class="btn btn-success approve_prof" >Approve</button>
            </div>

        </div>
    </div>
@endsection
