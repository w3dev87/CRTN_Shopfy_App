@extends('admin/layouts.admin')
@section('content')
    <div class="row">
        @if(empty($back_cat))
           After upload background image please add baground type.
            <?php
            return false;
            ?>
        @endif
        <div class="col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>Add Background Category </header>
                    <div class="tools">
                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    </div>
                </div>
                <div class="card-body ">
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <div class="col-lg-4 p-t-20 text-center">
                            <div class="mdl-textfield mdl-js-textfield">
                                <select name="" class="form-control" id="category_type">
                                    <option value="">Background Category</option>
                                    @if(!empty($back_cat))
                                      @foreach($back_cat as $single)
                                            <option value="{{$single['id']}}">{{$single['type_name']}}</option>
                                      @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
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
    </div>
@endsection