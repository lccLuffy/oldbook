<div class="col-md-8">
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">姓名</span> <input class="form-control" type="text"
                                                             disabled="true" value="{{$user->name}}">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">学号</span> <input class="form-control" type="text"
                                                             disabled="true" value="{{$user->stu_num}}">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">昵称</span> <input class="form-control" type="text" name="nickname"
                                                             value="{{$user->nickname}}">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">手机号码</span> <input class="form-control" type="text" name="phone_number"
                                                               value="{{$user->phone_number}}">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">地址</span> <input class="form-control" type="text" name="address"
                                                             value="{{$user->address}}">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">头像</span> <input class="form-control" type="file" name="avatar">
        </div>
    </div>

</div>