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
    <div class="row">
        @include('auth.partials.errors')
        @include('auth.partials.success')

        <div class="col-sm-12 col-md-12">
            @each('book.item_book',$books,'book')
        </div>
        <div class="col-sm-12 col-md-12">
            {!! $books->links() !!}
        </div>

    </div>
@endsection
