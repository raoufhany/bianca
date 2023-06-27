@CSRF
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{trans('common.table number')}}</label>
            <div class="controls">
                <input id="number" type="text" value="{{ isset($row) ? $row->number : old('number') }}" name="number" class="form-control" data-validation-required-message="{{trans('common.This field is required')}}" placeholder="{{trans('common.table number')}}">
            </div>
            @error('number')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="restaurantSelect">{{trans('common.restaurant')}}</label>
            <div class="controls">
                <select id="restaurantSelect" class="form-control" name="restaurant_id">
                    @foreach($restaurants as $key => $name)
                    <option value="{{ $key }}" {{ ((isset($row) && $row->restaurant_id == $key) || session('restaurant') !== null) ? 'selected' : '' }}>{{ $name }}</option>
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
</div>
