@extends('admin/layouts.admin')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="card-head">
                    <header> Upload Image</header>
                    <div class="tools">
                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    </div>
                </div>
                <div class="card-body ">
                    <form method="POST" id="add_image">
                        {{ csrf_field() }}
                        <input type="hidden" id="order_id" value="{{$id}}">
                        <div class="container drop_upload_pic">
                            <div>
                                <div class="drop_upload dz-clickable" id="drop">
                                    <div class="dz-message needsclick">
                                        <i class="fa fa-picture-o fa-5x" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection