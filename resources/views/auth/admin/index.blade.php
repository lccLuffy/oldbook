@extends('auth.admin.layout')
@section('content')

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <p>分类个数</p>
            </div>
            <div class="panel-body">
                <p class="caption">{{$category_count}}</p>
            </div>
            <a href="{{url('admin/category')}}">
                <div class="panel-footer">
                    <span class="pull-left">查看详情</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>

            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <p>书个数</p>
            </div>
            <div class="panel-body">
                <p class="caption">{{$book_count}}</p>
            </div>
            <a href="{{url('book')}}">
                <div class="panel-footer">
                    <span class="pull-left">查看详情</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>

            </a>
        </div>
    </div>
@stop

