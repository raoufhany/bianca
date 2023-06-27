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

    <div class="col-md-6">
        <div class="form-group">
            <label>{{trans('common.Enter Phone Number')}}</label>
            <div class="controls">
                <input type="text" value="{{ isset($row) ? $row->phone : old('phone') }}" name="phone" class="form-control" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="{{trans('common.The numeric field may only contain numeric characters.')}}" placeholder="{{trans('common.Enter Phone Number')}}">
            </div>
            @error('phone')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="media">
            <a href="javascript: void(0);">
                <img src="{{isset($row)? $row->image: asset('/admin_asset/app-assets/images/portrait/small/avatar-s-12.jpg')}}" class="rounded mr-75" alt="profile image" height="64" width="64">
            </a>
            <div class="media-body mt-75">
                <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                    <!-- <label>{{trans('common.Upload Photo')}}</label> -->
                    <input type="file" name="image" class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer">
                </div>
                <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF or PNG. Max
                        size of
                        2 MB</small></p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{trans('common.Enter Email')}}</label>
            <div class="controls">
                <input type="email" value="{{ isset($row) ? $row->email : old('email') }}" name="email" class="form-control" data-validation-required-message="{{trans('common.Must be a valid email')}}" placeholder="{{trans('common.Enter Email')}}" value="{{ old('email') }}">
            </div>
            @error('email')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{trans('common.Password Input Field')}}</label>
            <div class="controls">
                <input type="password" name="password" class="form-control" @if(!isset($row) ) data-validation-required-message="{{trans('common.This field is required')}}" @endif placeholder="{{trans('common.Password')}}">
            </div>
            @error('password')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{trans('common.Repeat password must match')}}</label>
            <div class="controls">
                <input type="password" name="password_confirmation" @if(!isset($row) ) data-validation-match-match="password" data-validation-required-message="{{trans('common.Repeat password must match')}}" @endif  class="form-control"  placeholder="{{trans('common.Repeat Password')}}">
            </div>
            @error('password_confirmation')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
</div>
