@extends('layouts.app')
@section('content')

    <div class="container-fluid" style="margin-top: 100px;">
        <ol class="breadcrumb">
            <li><a href="/home">首页</a></li>
            <li class="active">编辑书目</li>
        </ol>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        @include('auth.partials.errors')
                        @include('auth.partials.success')

                        <form class="form-horizontal" role="form" method="POST" action="{{route('book.update', $id)}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">

                            @include('book.form')

                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-2">
                                        <button type="submit" class="btn btn-primary btn-lg" name="action"
                                                value="continue">
                                            <i class="fa fa-floppy-o"></i>
                                            Save - Continue
                                        </button>
                                        <button type="submit" class="btn btn-success btn-lg" name="action"
                                                value="finished">
                                            <i class="fa fa-floppy-o"></i>
                                            Save - Finished
                                        </button>
                                        <button type="button" class="btn btn-danger btn-lg" data-toggle="modal"
                                                data-target="#modal-delete">
                                            <i class="fa fa-times-circle"></i>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

        {{-- 确认删除 --}}
        <div class="modal fade" id="modal-delete" tabIndex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            ×
                        </button>
                        <h4 class="modal-title">请确认</h4>
                    </div>
                    <div class="modal-body">
                        <p class="lead">
                            <i class="fa fa-question-circle fa-lg"></i>
                            确认要删除吗?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{url('book',$id)}}">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="hidden" name="_method" value="DELETE">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-times-circle"></i> Yes
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop