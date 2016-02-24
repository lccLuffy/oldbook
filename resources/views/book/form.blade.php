<div class="row">

    <div class="col-md-8" style="float: left">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-2 control-label">
                书名*
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="name" id="name" value="{{ $name }}">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-2 control-label">
                描述*
            </label>
            <div class="col-md-5">
                <textarea class="form-control" name="description" rows="5"
                          id="description">{{ $description }}</textarea>
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
            <label for="address" class="col-md-2 control-label">
                寝室地址*
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="address" id="address" value="{{ $address }}">

                </input>
                @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
            <label for="price" class="col-md-2 control-label">
                价格*
            </label>
            <div class="col-md-3 input-group" style="margin-left: 140px;">
                <input type="text" name="price" class="form-control" id="price" value="{{ $price }}"><span
                        class="input-group-addon">元</span>
            </div>
            <div class="col-md-3 input-group" style="margin-left: 140px;">
                @if ($errors->has('price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>

        </div>

        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
            <label for="phone_number" class="col-md-2 control-label">
                手机号码*
            </label>
            <div class="col-md-3 input-group" style="margin-left: 140px;">
                <input type="text" name="phone_number" class="form-control" id="phone_number"
                       value="{{ $phone_number }}">
            </div>
            <div class="col-md-3 input-group" style="margin-left: 140px;">
                @if ($errors->has('phone_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone_number') }}</strong>
                    </span>
                @endif
            </div>

        </div>

        <div class="form-group{{ $errors->has('other_contact_way') ? ' has-error' : '' }}">
            <label for="description" class="col-md-2 control-label">
                其他联系方式
            </label>
            <div class="col-md-5">
                <textarea class="form-control" name="other_contact_way" rows="3"
                          id="other_contact_way">{{ $other_contact_way }}</textarea>
                @if ($errors->has('other_contact_way'))
                    <span class="help-block">
                        <strong>{{ $errors->first('other_contact_way') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('pictures') ? ' has-error' : '' }}">
            <label for="pictures" class="col-md-2 control-label">
                图片*
            </label>
            <div class="col-md-5">
                <input type="file" id="pictures" style="margin-top: 10px;" name="pictures">
                @if ($errors->has('pictures'))
                    <span class="help-block">
                        <strong>{{ $errors->first('pictures') }}</strong>
                    </span>
                @endif
            </div>
        </div>

    </div>


    <div class="col-md-3 col-md-pull-2">
        <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
            <label for="categories" class="col-md-3 control-label">
                分类*
            </label>

            <div class="col-md-6">
                <select name="categories[]" id="categories" class="form-control" multiple>
                    @foreach ($allCategories as $id=> $category)
                        <option value="{{ $id}}" {{in_array($id,$categories) ? 'selected=selected':''}}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('categories'))
                    <span class="help-block">
                        <strong>{{ $errors->first('categories') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
    $('#categories').select2({
        placeholder:'选择标签',
        tags:true
    });
</script>
@endsection