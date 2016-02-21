@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1" style="margin-top: 200px;margin-bottom: 500px">
                <div class="panel panel-danger">
                    <div class="panel-heading">403 Forbidden</div>

                    <div class="panel-body">
                        您没有权限访问此页面
                    </div>
                    <div class="panel-footer">
                        <a href="{{url('/')}}">点击回到主页</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop