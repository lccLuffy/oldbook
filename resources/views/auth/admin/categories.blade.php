<div class="container-fluid">
    <div class="row page-title-row">
        <div class="col-md-6">
            <h3>书籍分类
                <small>» Listing</small>
            </h3>
        </div>
        <div class="col-md-6 text-right">


            <a href="{{route('admin.category.create')}}" class="btn btn-success btn-md"><i
                        class="fa fa-plus-circle"></i>New Category</a>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">

            @include('auth.partials.errors')
            @include('auth.partials.success')
            <ul class="list-group" id="category">
                @foreach ($categories as $category)
                    <li class="list-group-item list-group-item-heading list-group-item-success">{{ $category->name }}
                        <span class="badge">{{$category->books()->count()}}</span></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@section('scripts')
    {{--<script>
        $(function () {
            $("#category-table").DataTable({
                responsive: true
            });
        });
    </script>--}}
    <script src="http://libs.useso.com/js/highlight.js/7.5/highlight.min.js"></script>
    <script src="{{asset('/package/js/Sortable.min.js')}}"></script>
    <script>
        var list = document.getElementById("category");
        window.x = new Sortable(list,
                {
                    store: {
                        get: function (sortable) {
                            var order = localStorage.getItem(sortable.options.group);
                            return order ? order.split('|') : [];
                        },
                        set: function (sortable) {
                            var order = sortable.toArray();
                            localStorage.setItem(sortable.options.group, order.join('|'));
                        }
                    },
                    onAdd: function (evt) {
                        console.log('onAdd.foo:');
                    },
                    onUpdate: function (evt) {
                        console.log('onUpdate.foo:');
                    },
                    onRemove: function (evt) {
                        console.log('onRemove.foo:');
                    },
                    onStart: function (evt) {
                        evt.onmousedown==function(e)
                        {
                            console.log('onmousedown ',e.x);
                        }
                        console.log('onStart.foo:');
                    },
                    onEnd: function (evt) {
                        console.log('onEnd.foo:');
                    }
                });

    </script>
@endsection
