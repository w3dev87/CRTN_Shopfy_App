@extends('admin/layouts.admin')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>All Customer</header>
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
                            <th class="mdl-data-table__cell--non-numeric">First Name</th>
                            <th class="mdl-data-table__cell--non-numeric">Last Name</th>
                            <th class="mdl-data-table__cell--non-numeric">Email</th>
                           {{-- <th class="mdl-data-table__cell--non-numeric">Image</th>--}}
                            <th class="mdl-data-table__cell--non-numeric">Address</th>
                            <th class="mdl-data-table__cell--non-numeric">City</th>
                            <th class="mdl-data-table__cell--non-numeric">Country</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($customer_info))
                            @foreach($customer_info as $single)
                                <tr>
                                    <td class="mdl-data-table__cell--non-numeric">{{$single['first_name']}}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{$single['last_name']}}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{$single['email']}}</td>
                                    {{--<td class="mdl-data-table__cell--non-numeric"><img src="{{(!empty($single['customer_img']['image']))?$single['customer_img']['image']:''}}" alt="" style="max-width:100px"></td>--}}
                                    <td class="mdl-data-table__cell--non-numeric">{{$single['address']}}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{$single['city']}}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{$single['country']}}</td>
                                   {{-- <td class><a href="{{url('/admin/change_background/'.$single['id'])}}" class="btn btn-success">Change Background</a></td>--}}
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