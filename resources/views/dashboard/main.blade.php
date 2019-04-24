<?php
$status_arr = [
    '1' =>'Processing',
    '2' =>'Selected',
    '3' =>'Approved',
    '4' =>'Success',
];
?>
@extends('layouts.app')
@section('content')
    <input type="hidden" id="order_id" value="{{$order_info['id']}}">

    <div class="container card  main">
        <div class="row ">
            <div class="col-12 md-12">
                <p class="orderNumber mt-1">Order  # {{$order_info['order_number']}}</p>

            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <div class="imageProduct_home zoom">
                    <img src="{{asset('images/'.$order_info['id'].'/product_image/'.$product['product_image'])}}" class="productImage" id="productImage" alt="...">
                </div>
            </div>
            <div class="col-6 description">
                <p class="price">{{$status_arr[$order_info['status']]}}</p>
                <p class="title">{{$product['product_name']}}</p>
                <p class="title">${{$order_info['price']}}</p>
            </div>
        </div>
        <div class="row mb-3">
         {{--   @if($order_info['status'] == 2)--}}
                <div class="col-12 col-md-11 mb-1">
                    <div class="imageViews zoom " style="background-image: url({{asset('backgrounds/'.$background['image'])}})">
                        <img src="{{$product['user_image']}}" class="card-img-top productImage " alt="..." >
                    </div>
                </div>
          {{--  @endif--}}
            @if(!empty($va_images))
                <div class="col-12 col-md-6">
                    <div class="imageViews zoom">
                        <img src="{{asset('images/'.$order_info['id'].'/'.$va_images['image'])}}" class="card-img-top" alt="..." >
                    </div>
                </div>
            @endif
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <div class="buttonsContainer">
                    @if($order_info['status'] < 4)
                        <a href="{{route('view_proof')}}" class="button view_prof">View Proof</a>
                    @endif
                        @if($order_info['status'] == 3)
                        <button type="button"  class="button order_notes">Request Fix</button>
                    @endif
                </div>
            </div>
        </div>
        @if($order_info['status'] == 3)
            <div class="row mb-4">
                <div class="col-12">
                    <button type="button" class="btn btn-primary float-right apply_order">Apply</button>
                </div>
            </div>
        @endif
    </div>
@endsection

<div class="modal fade" id="fix_request" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Fix</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="answer">

                </div>
                <form action="">
                    <div class="form-group-lg">
                        <textarea name="" class="form-control" id="order_notes_msg"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary col-4 send_fix_request">Send</button>
            </div>
        </div>
    </div>
</div>


