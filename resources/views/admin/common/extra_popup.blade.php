
<!-- Modal Create Donor -->
<div class="modal fade bd-example-modal-lg" id="createExtra" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ trans('common.edit item extra') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.extras.store') }}" class="user-form-popup" id="createExtraForm" method="POST">
                <div class="modal-body">
                    <div class="card-body">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="restaurant_id" value="{{ session('restaurant.id') }}">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label><span class="danger">*</span> {{trans('common.popup note')}} <span class="danger">*</span></label>
                                </div>
                            </div>
                            <br>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="name">{{trans('common.Enter Name')}} <span class="danger">*</span></label>
                                    <div class="controls">
                                        <input id="name" type="text" name="name" class="form-control" data-validation-required-message="{{trans('common.This field is required')}}" placeholder="{{trans('common.Enter Name')}}">
                                    </div>
                                    @error('name')
                                        <small class=" text text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="price">{{trans('common.price')}} <span class="danger">*</span></label>
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
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="reset" class="btn btn-info" value="Reset">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="submitExtraFormFunction()" id="submitExtraForm" class="btn btn-blue waves-effect waves-light">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end page donor create -->
