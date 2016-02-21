<div class="container-fluid">
    <div class="row page-title-row">
        <div class="col-md-6">
            <h3>用户
                <small>» Listing</small>
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">

            <table id="users-table" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="hidden-md">ID</th>
                    <th class="hidden-md">用户名</th>
                    <th class="hidden-md">昵称</th>
                    <th class="hidden-md">学号</th>
                    <th class="hidden-md">邮箱</th>
                    <th class="hidden-md">管理员</th>
                    <th data-sortable="false">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="hidden-sm">{{ $user->id }}</td>
                        <td class="hidden-sm">{{ $user->name }}</td>
                        <td class="hidden-sm">{{ $user->nickname }}</td>
                        <td class="hidden-sm">{{ $user->stu_num }}</td>
                        <td class="hidden-sm">{{ $user->email }}</td>
                        @if(isAdmin($user))
                            <td class="hidden-sm">是</td>
                        @else
                            <td class="hidden-sm">否</td>
                        @endif

                        <td>
                            <a href='#' class="btn btn-xs btn-info">
                            <i class="fa fa-edit"></i> 编辑
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('scripts')
    @parent
    <script>
        $(function () {
            $("#users-table").DataTable();
        });
    </script>
@stop
