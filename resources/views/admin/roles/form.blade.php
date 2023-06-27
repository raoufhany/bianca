@CSRF
<div class="row">
    <div class="col-md-12">
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

    @php
    $models = [
        'user',
        'role',
        'admin',
        'driver',
        'category',
    ];
    $maps = ['create', 'list', 'edit', 'delete'];
    @endphp

    @foreach ($models as $index => $model)
    <div class="list-group col-md-3" style="padding-left: 15px !important; padding-right: 15px !important;">
        <a href="#" class="list-group-item active">
            {{ trans('common.'.$model) }}
        </a>
        @foreach ($maps as $map)
        <label><input type="checkbox" name="permission[]"
            {{ isset($rolePermissions) && in_array($model . '-' . $map,$rolePermissions)  ? 'checked' : '' }}
            value="{{ $model . '-' . $map }}"> {{ trans('common.'.$map) }}</label>
        <hr>
        @endforeach
    </div>

    @endforeach

</div>
