@extends('layouts.app')
@section('content')
    @include('auth.partials.errors')
    @include('auth.partials.success')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">个人资料
            </h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <th class=" col-md-2 text-center">头像</th>
                    <td class="col-md-3 text-center">
                        @if($user->avatar)
                            <img src="{{$user->avatar.'?imageView2/1/w/100/h/100'}}"
                                 class="img-circle img-thumbnail img-responsive"
                                 style="height: 100px;width: 100px">
                        @else
                            无
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class=" col-md-2 text-center">学号</th>
                    <td class="col-md-3 text-center">{{$user->stu_num}}</td>
                </tr>

                <tr>
                    <th class=" col-md-2 text-center">姓名</th>
                    <td class="col-md-3 text-center">{{$user_info['姓名']}}</td>
                </tr>

                <tr>
                    <th class=" col-md-2 text-center">院系</th>
                    <td class="col-md-3 text-center">{{$user_info['院系']}}</td>
                </tr>

                <tr>
                    <th class=" col-md-2 text-center">地址</th>
                    <td class="col-md-3 text-center">{{$user->address}}</td>
                </tr>

                <tr>
                    <th class=" col-md-2 text-center">昵称</th>
                    <td class="col-md-3 text-center">{{$user->nickname}}</td>
                </tr>

                <tr>
                    <th class=" col-md-1 text-center">学号</th>
                    <td class="col-md-3 text-center">{{$user_info['学号']}}</td>
                </tr>


            </table>
        </div>
    </div>
    @can('update.user',$user)
    <button class="btn btn-default"
            onclick="show_dialog()">修改资料
    </button>
    @endcan
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th class="col-md-1 text-center">书名</th>
            <th class="col-md-1 text-center">类别</th>
            <th class="col-md-1 text-center">手机号码</th>
            <th class="col-md-1 text-center">其他联系方式</th>
            <th class="col-md-1 text-center">书本地址</th>
            <th class="col-md-1 text-center">描述</th>
            <th class="col-md-1 text-center">状态</th>
            <th class="col-md-1 text-center">价格</th>
            <th class="col-md-1 text-center">发布时间</th>

        </tr>
        @foreach($user->books as $book)
            <div class="col-md-9">
                <tr>
                    <td class="col-md-1 text-center"><a
                                href="{{route('book.show',$book->id)}}">{{$book->name}}</a></td>
                    <td class="col-md-1 text-center">
                        @foreach($book->categories as $category)
                            <p>{{$category->name}}</p>
                        @endforeach
                    </td>
                    <td class="col-md-1 text-center">{{ $book->phone_number}}</td>
                    <td class="col-md-1 text-center">{{ $book->other_contact_way}}</td>
                    <td class="col-md-1 text-center">{{ $book->address}}</td>
                    <td class="col-md-1 text-center">{{ $book->description}}</td>
                    <td class="col-md-1 text-center">{{ $book->status}}</td>
                    <td class="col-md-1 text-center">{{ $book->price}}元</td>
                    <td class="col-md-1 text-center">{{ $book->updated_at}}</td>
                </tr>
            </div>
        @endforeach
    </table>

    <p>卖出的书</p>
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th class=" col-md-1 text-center">书名</th>
            <th class="col-md-1 text-center">买家</th>
            <th class="col-md-1 text-center">买家地址</th>
            <th class="col-md-1 text-center">买家手机号码</th>
            <th class="col-md-1 text-center">买家其他联系方式</th>
            <th class="col-md-1 text-center">买家留言</th>
            <th class="col-md-1 text-center">订单状态</th>
            <th class="col-md-1 text-center">订单日期</th>

        </tr>
        @foreach($user->beBoughtOrders as $order)
            <tr>
                <?php $buyer = $order->user;$book = $order->book;?>
                <th class=" col-md-1 text-center"><a href="{{route('book.show',$book->id)}}">{{$book->name}}</a>
                </th>
                <td class="col-md-1 text-center"><a
                            href="{{route('user.center',$buyer->id)}}">{{$buyer->name}}</a>
                </td>
                <td class="col-md-1 text-center">{{$order->address}}</td>
                <td class="col-md-1 text-center">{{$order->phone_number}}</td>
                <td class="col-md-1 text-center">{{$order->other_contact_way}}</td>
                <td class="col-md-1 text-center">{{$order->message}}</td>
                <td class="col-md-1 text-center">{{$order->status}}</td>
                <td class="col-md-1 text-center">{{$order->created_at}}</td>
            </tr>
        @endforeach
    </table>
    <p>我下的订单</p>
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th class=" col-md-1 text-center">书名</th>
            <th class="col-md-1 text-center">卖家</th>
            <th class="col-md-1 text-center">卖家地址</th>
            <th class="col-md-1 text-center">卖家手机号码</th>
            <th class="col-md-1 text-center">卖家其他联系方式</th>
            <th class="col-md-1 text-center">卖家描述</th>
            <th class="col-md-1 text-center">订单状态</th>
            <th class="col-md-1 text-center">订单日期</th>
        </tr>
        @foreach($user->orders as $order)
            <tr>
                <?php $seller = $order->seller;$book = $order->book ?>
                <th class=" col-md-1 text-center"><a href="{{route('book.show',$book->id)}}">{{$book->name}}</a>
                </th>
                <td class="col-md-1 text-center"><a
                            href="{{route('user.center',$seller->id)}}">{{$seller->name}}</a>
                </td>
                <td class="col-md-1 text-center">{{$book->address}}</td>
                <td class="col-md-1 text-center">{{$book->phone_number}}</td>
                <td class="col-md-1 text-center">{{$book->other_contact_way}}</td>
                <td class="col-md-1 text-center">{{$book->description}}</td>
                <td class="col-md-1 text-center">{{$order->status}}</td>
                <td class="col-md-1 text-center">{{$order->created_at}}</td>
            </tr>
        @endforeach

    </table>

    @can('update.user',$user)

    <div class="modal fade" id="modal-file-delete">
        <form method="post" action="{{route('user.update')}}" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            ×
                        </button>
                        <h4 class="modal-title">修改个人资料</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-horizontal">

                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    {!! csrf_field() !!}
                                    @include('auth.form')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            取消
                        </button>
                        <button type="submit" class="btn btn-danger" type="submit" onclick="showProgress()">
                            提交修改
                        </button>
                        <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw margin-bottom" id="progress"></i>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endcan
@stop
@section('scripts')
    <script>
        // 确认文件删除
        $(document).ready(function () {
            $('#progress').hide();
        })
        function show_dialog() {
            $("#modal-file-delete").modal("show");
        }
        function showProgress() {
            $('#progress').show();
        }
    </script>
@endsection