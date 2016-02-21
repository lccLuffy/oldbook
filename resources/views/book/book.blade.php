@extends('layouts.app')
@section('content')
    @include('auth.partials.success')
    @include('auth.partials.errors')
    <div class="" style="margin-top: 100px;margin-bottom: 150px;">
        <div class="row-fluid">
            @foreach($book->pictures as $picture)
                <div class="col-sm-3 col-md-3">
                    <a href="#" class="thumbnail">
                        <img style="max-width: 200px;max-height: 300px;" class="img-thumbnail" src="{{$picture->url}}">
                    </a>
                </div>
            @endforeach
        </div>
        <div>
            <table class="table table-striped table-hover table-bordered">
                <tr>
                    <th class="col-md-1 text-center">教材名称</th>
                    <td class="col-md-1 text-center">{{ $book->name }}</td>
                </tr>
                <tr>
                    <th class="col-md-1 text-center">类别</th>
                    <td class="col-md-1 text-center">
                        @foreach($book->categories as $category)
                            <span class="label label-info">{{$category->name}}</span>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th class="col-md-1 text-center">描述</th>
                    <td class="col-md-1 text-center">{{ $book->description}}</td>
                </tr>
                <tr>
                    <th class="col-md-1 text-center">价格</th>
                    <td class="col-md-1 text-center">{{ $book->price}}元</td>
                </tr>
                <tr>
                    <th class="col-md-1 text-center">地址</th>
                    <td class="col-md-1 text-center">{{ $book->address}}</td>
                </tr>
                <tr>
                    <th class="col-md-1 text-center">发布时间</th>
                    <td class="col-md-1 text-center">{{ $book->updated_at}}</td>
                </tr>
                <tr>
                    <th class="col-md-1 text-center">手机号码</th>
                    <td class="col-md-1 text-center">{{ $book->phone_number}}</td>
                </tr>
                <tr>
                    <th class="col-md-1 text-center">其他联系方式</th>
                    <td class="col-md-1 text-center">{{ $book->other_contact_way}}</td>
                </tr>
                <tr>
                    <?php $user = $book->user;?>
                    <th class="col-xs-1 text-center">发布人</th>

                    <td class="col-md-1 text-center"><a
                                href="{{url_user_center($user->id)}}">{{$user->name}}</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <form method="get" action="{{route('order.create')}}" class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="book_id" value="{{ $book->id }}">
        <button type="submit" class="btn btn-primary">
            购买
        </button>
    </form>
@stop
