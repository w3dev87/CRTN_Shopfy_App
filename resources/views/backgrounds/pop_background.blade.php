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
<div class="container-fluid backgroundPage">
    <div class="container text-lg-center">
        <div class="container cont_main">
            <div class="backg_main" data-order="{{$order_info['id']}}">
                <div class="item zoom zoom_img">
                    <img src="{{$product['user_image']}}" class="card-img-top" alt="...">
                </div>
            </div>
            <div class="container mb-3 selectCategory background_type">
                <p class="title">Select backgrounds category</p>
                <select name="" class="form-control " id="backgroundsCategory">
                    <option value="">All type</option>
                    @if(!empty($background_type))
                        @foreach($background_type as $single)
                            <option value="{{$single['id']}}">{{$single['type_name']}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="background slider-nav">
                @if(!empty($backgrounds))
                    @foreach($backgrounds as $single)
                        <div data-id="{{$single['id']}}" class="item single_image type_{{$single['type_id']}}">
                            <img  src="{{asset('backgrounds/'.$single['image'])}}" alt="">
                            <span class="slick-slide-name">Name</span>
                        </div>

                    @endforeach
                @endif
            </div>
            <div class="product_overvie_cont ">
                <button type="button" class="btn btn-success approve_prof" >Select</button>
            </div>
        </div>
    </div>
</div>
@endsection
