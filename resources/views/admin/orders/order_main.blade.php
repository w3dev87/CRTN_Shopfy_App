@extends('admin/layouts.admin')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>All Orders</header>
                    <div class="tools">
                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    </div>
                </div>
                <div class="card-body ">
                    <table
                            class="mdl-data-table ml-table-striped ml-table-bordered mdl-js-data-table ">
                        <thead>
                        <tr>
                            <th>Order Number</th>
                            <th class="mdl-data-table__cell--non-numeric">Email</th>
                            <th class="mdl-data-table__cell--non-numeric">Status</th>
                            <th class="mdl-data-table__cell--non-numeric">Upload Artwork</th>
                            <th class="mdl-data-table__cell--non-numeric">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($orders))
                            @foreach($orders as $single)
                            <tr>
                                <td>{{$single['order_number']}}</td>
                                <td class="mdl-data-table__cell--non-numeric">{{$single['user_email']}}</td>
                                <td class="mdl-data-table__cell--non-numeric">{{$single['status']}}</td>
                                <td class="mdl-data-table__cell--non-numeric"><a href="{{url('/admin/upload_image/'.$single['id'])}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Upload Image</a></td>
                                <td class="mdl-data-table__cell--non-numeric"><a data-id="{{$single['order_number']}}" class="view_detail">View Detail</a></td>
                            </tr>
                            <tr style="display:none;" class="detail_{{$single['order_number']}}">
                                <td colspan="5">
                                    <table class="col-lg-12">
                                        <tr>
                                            <th class="col-lg-4">
                                                User Image
                                            </th>
                                            <th class="col-lg-4">
                                                Background Image
                                            </th>
                                            <th class="col-lg-4">
                                                Artwork Image
                                            </th>
                                        </tr>
                                        <tr>
                                            @if(!empty($single->products->user_image))
                                            <td class="col-lg-4">
                                                <img src="{{$single->products->user_image}}" class="img-show" alt=""><br>
                                                <a download href="{{$single->products->user_image}}"> Download </a>
                                            </td>
                                            @endif
                                            @if(!empty($single->background->image))
                                                <td class="col-lg-4">
                                                    <img src="{{URL::to('/backgrounds').'/'.$single->background->image}}" class="img-show" alt=""><br>
                                                    <a download href="{{URL::to('/backgrounds').'/'.$single->background->image}}"> Download </a>
                                                </td>
                                            @endif
                                            @if(!empty($single->artwork->image))
                                            <td class="col-lg-4">
                                                <img src="{{URL::to('/images/'.$single['id']).'/'.$single->artwork->image}}" class="img-show" alt=""><br>
                                                <a download href="{{URL::to('/images/'.$single['id']).'/'.$single->artwork->image}}"> Download </a>
                                            </td>
                                            @endif
                                        </tr>
                                        <tr><td colspan="3"><h4>Notes</h4></td></tr>
                                        <tr>
                                            <td colspan="3">
                                                @if(!empty($single->notes))
                                                    @foreach($single->notes as $note)
                                                        <div>
                                                        {{$note->note}}
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection