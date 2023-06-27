@CSRF
<div class="row">
    @if(isset($restaurants))
        <div class="col-md-6">
            <div class="form-group">
                <label for="restaurantSelect">{{trans('common.restaurant')}}</label>
                <div class="controls">
                    <select id="restaurantSelect" class="form-control" name="restaurant_id">
                        <option value="">-- {{trans('common.select restaurant')}} --</option>
                        @foreach($restaurants as $key => $name)
                            <option value="{{ $key }}" {{ (old('restaurant_id') == $key) ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('restaurant_id')
                <small class=" text text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="adminMenuSelect">{{trans('common.menu')}}</label>
                <div class="controls">
                    <select id="adminMenuSelect" class="form-control" name="menu_id">
                        <option value="">-- {{trans('common.select menu')}} --</option>
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
                <label for="adminCategorySelect">{{trans('common.category')}}</label>
                <div class="controls">
                    <select id="adminCategorySelect" class="form-control" name="category_id">
                        <option value="">-- {{trans('common.select category')}} --</option>
                    </select>
                </div>
                @error('category_id')
                <small class=" text text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
    @elseif(isset($categories))
        <div class="col-md-6">
            <div class="form-group">
                <label for="categorySelect">{{trans('common.category')}}</label>
                <div class="controls">
                    <select id="categorySelect" class="form-control" name="category_id">
                        <option value="">-- {{trans('common.select category')}} --</option>
                        @foreach($categories as $key => $name)
                            <option value="{{ $key }}" {{ (isset($row) && $row->category_id == $key) ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                <small class=" text text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
                @enderror
            </div>
        </div>
    @endif

    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{trans('common.name')}}</label>
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
        <label>{{trans('common.image')}}</label>
        <div class="media">
            <a href="javascript: void(0);">
                <img id="image" src="{{isset($row)? asset('images/' . $row->category->menu->restaurant->name . '/items/' . $row->image) : asset('/admin_asset/app-assets/images/portrait/small/avatar-item.png')}}" class="rounded mr-75" alt="profile image" height="64" width="64">
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

    <div class="col-md-6">
        <div class="form-group">
            <label for="price">{{trans('common.price')}}</label>
            <div class="controls">
                <input id="price" type="number" value="{{ isset($row) ? $row->price : old('price') }}" name="price" class="form-control" data-validation-required-message="{{trans('common.This field is required')}}" placeholder="{{trans('common.price')}}">
            </div>
            @error('price')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="description">{{trans('common.description')}}</label>
            <div class="controls">
                <input id="description" type="text" value="{{ isset($row) ? $row->description : old('description') }}" name="description" class="form-control" data-validation-required-message="{{trans('common.This field is required')}}" placeholder="{{trans('common.description')}}">
            </div>
            @error('description')
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

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label for="item_extra_select">{{trans('common.itemExtra')}}</label>
            <div class="controls">
                <select id="item_extra_select" class="form-control js-example-basic-multiple js-states select2-with-clear-popup" multiple name="extra[]">
                    @foreach($extras as $key => $name)
                        <option value="{{ $key }}" {{ (isset($row) && in_array($key, $itemExtras)) ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            @error('extra')
                <small class=" text text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </small>
            @enderror
        </div>
    </div>
</div>
