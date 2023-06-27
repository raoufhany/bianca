@CSRF
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{trans('common.Enter Name')}} <span class="danger">*</span></label>
            <div class="controls">
                <input id="name" type="text" value="{{ isset($row) ? $row->name : old('name') }}" name="name" class="form-control" data-validation-required-message="{{trans('common.This field is required')}}" placeholder="{{trans('common.Enter Name')}}">
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
            <label for="menuSelect">{{trans('common.menu')}} <span class="danger">*</span></label>
            <div class="controls">
                <select id="menuSelect" class="form-control" name="menu_id">
                    @foreach($menus as $key => $name)
                    <option value="{{ $key }}" {{ (isset($row) && $row->menu_id == $key) ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            @error('menu_id')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="statusSelect">{{trans('common.Status')}} <span class="danger">*</span></label>
            <div class="controls">
                <select id="statusSelect" class="form-control" name="status">
                    @foreach($statuses as $key => $name)
                        <option value="{{ $key }}" {{ (isset($row) && $row->status->value == $key) ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            @error('status')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <label>{{trans('common.image')}}</label>
        <div class="media">
            <a href="javascript: void(0);">
                <img id="image" src="{{isset($row)? asset('images/' . $row->menu->restaurant->name . '/categories/' . $row->image) : asset('/admin_asset/app-assets/images/portrait/small/avatar-menu.png')}}" class="rounded mr-75" alt="profile image" height="64" width="64">
            </a>
            <div class="media-body mt-75">
                <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                    <!-- <label>{{trans('common.Upload Photo')}}</label> -->
                    <input onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])" type="file" name="image" class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer">
                </div>
                <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF or PNG. Max
                        size of
                        2 MB</small></p>
            </div>
        </div>
    </div>

    @if(isset($row))
        <div class="col-md-6">
            <div class="form-group">
                <label for="positionSelect">{{trans('common.position')}} <span class="danger">*</span></label>
                <div class="controls">
                    <select id="positionSelect" class="form-control" name="position">
                        @foreach($positions as $position)
                            <option value="{{ $position }}" {{ $row->position == $position ? 'selected' : '' }}>{{ $position }}</option>
                        @endforeach
                    </select>
                </div>
                @error('position')
                <small class=" text text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
    @endif
</div>
