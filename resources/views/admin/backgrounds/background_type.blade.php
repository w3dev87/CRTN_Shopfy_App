@extends('admin/layouts.admin')
@section('content')
    <div class="row">
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
                                <input class="mdl-textfield__input"  type="text" id="cat_name">
                                <label class="mdl-textfield__label" for="text1">Category Name</label>
                            </div>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                            <button
                                    type="button"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent add_background_category">
                                Add
                            </button>
                        </div>
                    </form>
                </div>

                </div>
            </div>
        </div>
    </div>
@endsection