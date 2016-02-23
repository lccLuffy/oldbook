@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <div>
                <h2>电子科技大学二手书交易平台</h2><br>
                <p class="text-warning">
                    <small>通过网站购买教材</small>
                </p>
                <p class="text-warning">
                    <small>会有同学讲书送到您的手中</small>
                </p>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <form id="form" class="form-horizontal" role="form" method="get" action="{{route('book.search')}}">
            <div class="input-group col-xs-6" style="margin-bottom: 20px;margin-left: 50px;">
                <input type="text" class="form-control" placeholder="查找您需要的教材名称" id="search_key" name="key">
                <span class="btn btn-default" onclick="onSubmit()">查找</span>
            </div>
        </form>
        @include('auth.partials.errors')
        @include('auth.partials.success')
        <div class="col-sm-2 col-md-2">
            <ul class="list-group">
                <li class="list-group-item list-group-item-heading list-group-item-{{$category_id <= 0 ? 'success' :'info'}}">
                    <a href="{{url('book')}}">全部教材<span
                                class="badge">{{App\Book::count()}}</span></a></li>
                @foreach($categories as $category)
                    <li class="list-group-item list-group-item-heading list-group-item-{{$category_id == $category->id ? 'success' :'info'}}">
                        <a
                                href="{{route('book.category',$category->id)}}">{{$category->name}}<span
                                    class="badge">{{$category->books()->count()}}</span></a></li>
                @endforeach
            </ul>
        </div>

        <div class="col-sm-10 col-md-10" id="book_panel">
            @each('book.item_book',$books,'book')
        </div>

        <div class="col-sm-12 col-md-12">
            {!! $books->links() !!}
        </div>

    </div>
@endsection
