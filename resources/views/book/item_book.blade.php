<div class="col-sm-3 col-md-3">
    <div class="panel panel-info" style="height: 450px">
        <div class="panel-heading">
            <div class="panel-title">书名:{{$book->name}}</div>
        </div>
        <div class="panel-body">
            <img class="img-thumbnail" src="{{$book->pictures()->first()->url}}"
                 style="width: 250px;height: 250px">

            <ul class="list-inline">
                <li><i class="fa fa-clock-o"></i>{{ $book->created_at->diffForHumans() }}</li>
                @foreach($book->categories as $category)
                    <li><i class="fa fa-tag"><a href="{{route('book.category',$category->id)}}">{{$category->name}}</a></i>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="panel-footer">
            <a href="{{route('book.show',$book->id)}}" class="btn btn-default" role="button">查看</a>
            @can('update.book',$book)
            <a href="{{route('book.edit',$book->id)}}" class="btn btn-default"
               role="button">编辑</a>
            @endcan
        </div>
    </div>
</div>