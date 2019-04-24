
@extends('admin/layouts.admin')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>All Request fix</header>
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
                            <th class="mdl-data-table__cell--non-numeric">Msg</th>
                            <th class="mdl-data-table__cell--non-numeric">Customer name</th>
                            <th class="mdl-data-table__cell--non-numeric">Customer email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($order_notes))
                            @foreach($order_notes as $single)
                                <tr>
                                    <td>{{$single->order_note['order_number']}}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{$single['note']}}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{$single['author_name']}}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{$single['author_email']}}</td>
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