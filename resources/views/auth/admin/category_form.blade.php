<div class="form-group">
    <label for="title" class="col-md-3 control-label">
        Name
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="name" id="name" value="{{ $name }}">
    </div>
</div>


<div class="form-group">
    <label for="meta_description" class="col-md-3 control-label">
        Meta Description
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="meta_description" id="meta_description" value="{{ $meta_description }}">
    </div>
</div>

<div class="form-group">
    <label for="page_image" class="col-md-3 control-label">
        Category Image
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="category_image" id="category_image" value="{{ $category_image }}">
    </div>
</div>

{{--

<div class="form-group">
    <label for="reverse_direction" class="col-md-3 control-label">
        Direction
    </label>
    <div class="col-md-7">
        <label class="radio-inline">
            <input type="radio" name="reverse_direction" id="reverse_direction"
                   @if (! $reverse_direction)
                   checked="checked"
                   @endif
                   value="0">
            Normal
        </label>
        <label class="radio-inline">
            <input type="radio" name="reverse_direction"
                   @if ($reverse_direction)
                   checked="checked"
                   @endif
                   value="1">
            Reversed
        </label>
    </div>
</div>--}}
