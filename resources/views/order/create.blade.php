@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-12">
                <h3>订单
                    <small>» 编辑订单</small>
                </h3>
            </div>
        </div>

        @include('auth.partials.errors')
        @include('auth.partials.success')

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">编辑</h3>
                    </div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{route('order.store')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="book_id" value="{{$book->id}}">
                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label">
                                    卖家*
                                </label>
                                <div class="col-md-3 input-group">
                                    <input disabled='true' type="text" class="form-control"
                                           value="{{ $book->user->name }}">
                                    <a class="input-group-addon" href="{{route('user.center',$book->user->id)}}">
                                        详情*
                                    </a>
                                </div>
                            </div>
                            <a href="{{route('book.show',$book->id)}}">
                                <div class="form-group">
                                    <label for="name" class="col-md-2 control-label">
                                        书名*
                                    </label>
                                    <div class="col-md-3 input-group">
                                        <input disabled='true' type="text" class="form-control"
                                               value="{{ $book->name }}">

                                    </div>
                                </div>
                            </a>

                            <div class="form-group">
                                <label for="address" class="col-md-2 control-label">
                                    地址*
                                </label>
                                <div class="col-md-3 input-group">
                                    @if(old('address'))
                                        <input name='address' type="text" class="form-control"
                                               value="{{old('address')}}">
                                    @else
                                        <input name='address' type="text" class="form-control"
                                               value="{{Auth::user()->address}}">
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone_number" class="col-md-2 control-label">
                                    手机号码*
                                </label>
                                <div class="col-md-3 input-group">
                                    <input name='phone_number' type="number" class="form-control"
                                           value="{{old('phone_number',Auth::user()->phone_number)}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="other_contact_way" class="col-md-2 control-label">
                                    其他联系方式
                                </label>
                                <div class="col-md-3 input-group">
                                    <input name='other_contact_way' type="text" class="form-control"
                                           value="{{old('other_contact_way')}}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-md-2 control-label">
                                    留言
                                </label>
                                <div class="col-md-5 input-group">
                                    <textarea class="form-control" name="message" rows="5"
                                              id="description">{{ old('message') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-2">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fa fa-disk-o"></i>
                                            确定
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop