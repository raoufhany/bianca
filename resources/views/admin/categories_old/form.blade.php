@CSRF
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{trans('common.Enter Name')}}</label>
            <div class="controls">
                <input type="text" value="{{ isset($row) ? $row->name : old('name') }}" name="name" class="form-control" data-validation-containsnumber-regex="^[a-zA-Z\s]+$" data-validation-required-message="{{trans('common.This field is required')}}" placeholder="{{trans('common.Enter Name')}}" value="{{ old('name') }}">
            </div>
            @error('name')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <input type="hidden" value="{{ session()->get('mainCategory') }}" name="main">

    @if(!session()->get('mainCategory'))
    <div class="col-md-6">
        <div class="form-group">
            <label>{{trans('common.parent')}}</label>
            <div class="controls">
                <select name="parent_id" class="form-control selectpicker" >
                    <option value="">{{ trans('common.select Category') }}</option>
                    @foreach($append['categories'] as $category)
                        <option {{ isset($row) && $category->id == $row->parent_id ? 'selected':'' }} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            @error('parent_id')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    @endif
</div>
