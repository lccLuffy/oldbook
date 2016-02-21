@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('auth.partials.errors')
                <div class="panel panel-default">
                    <div class="panel-heading">验证信息-注册</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">昵称*</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="nickname"
                                           value="{{ old('nickname') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">学号*</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="stu_num"
                                           value="{{ old('stu_num') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">信息门户密码*</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="stu_psw"
                                           value="{{ old('stu_psw') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">邮箱*</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">地址</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="address"
                                           value="{{ old('address') }}">
                                    <label class="label-info">[建议填写,比如校区，寝室，买/卖书时方便，配送方便]</label>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i>Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
