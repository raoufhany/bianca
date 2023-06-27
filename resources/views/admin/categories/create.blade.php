@extends('admin.common.index')
@section('meta')
<link rel="stylesheet" type="text/css" href="{{asset('/admin_asset/app-assets/css/plugins/forms/validation/form-validation.css')}}">
@endsection
@section('page_title')
{{trans('common.create category')}}
@endsection
@section('content')

@include('admin.common.extra_popup')

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
        <p class="mb-0">
            {{$error}}
        </p>
        @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true"><i class="feather icon-x-circle"></i></span>
    </button>
</div>
@endif

<!-- Input Validation start -->
<section class="input-validation">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{trans('common.create category')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form-horizontal" novalidate
                            action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                            @include('admin.categories.form')
                            <input type="hidden" id="items_number" name="items_number" value="0">
                            <div class="col-sm-12 col-md-12 mb-4">
                                <button type="button" onclick="addItem()" class="btn btn-primary btn-sm float-right">
                                    <i class="mdi mdi-plus-box"></i>
                                    {{ trans('common.create item') }}
                                </button>
                            </div>
                            <hr>
                            <div class="more_item">

                            </div>
                            <button type="submit" class="btn btn-primary">{{trans('common.Submit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Input Validation end -->
@endsection

@section('script')
    <script src="{{asset('/admin_asset/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('/admin_asset/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>

    <script>
        let itemIndex = 0;
        const  itemExtraArr = {};

        function addItem() {
            let title = '{{ trans('common.item') }}';

            let divCollapse = $(
                '<div class="col-sm-12 col-md-12 item">\n' +
                '<div id="item' + itemIndex + '" class="card accordion">\n' +
                '    <div class="card-header collapsed" aria-expanded="true" data-toggle="collapse" href="#collapse' + itemIndex + '" aria-controls="collapse' + itemIndex + '">\n' +
                '       <a class="card-title">\n' +
                '          <b>' + (title) + '</b>\n' +
                '        </a>\n' +
                '    </div>\n' +
                '\n' +
                '    <div id="collapse' + itemIndex + '" class="collapse show">\n' +
                '      <div class="card-body">\n' +
                '        <div class="row">' +
                '           <div class="col-md-6"> \n'+
                '               <div class="form-group"> \n'+
                '                   <label for="item_name_' + itemIndex + '">{{trans('common.name')}} <span class="danger">*</span></label>\n'+
                '                       <div class="controls">\n'+
                '                           <input id="item_name_' + itemIndex + '" type="text" value="{{ isset($row) ? $row->name : old('name') }}" name="item_name[' + itemIndex + ']" class="form-control" data-validation-required-message="{{trans('common.This field is required')}}" placeholder="{{trans('common.Enter Name')}}">\n'+
                '                       </div>\n'+
                '                       @error('name')\n'+
                '                           <small class=" text text-danger" role="alert">\n'+
                '                               <strong>{{ $message }}</strong>\n'+
                '                           </small>\n'+
                '                       @enderror'+
                '               </div>\n'+
                '           </div>\n'+

                '           <div class="col-md-6">\n'+
                '               <label>{{trans('common.image')}}</label>\n'+
                '               <div class="media">\n'+
                '                   <a href="javascript: void(0);">\n'+
                '                       <img id="item_image_' + itemIndex + '" src="{{asset('/admin_asset/app-assets/images/portrait/small/avatar-item.png')}}" class="rounded mr-75" alt="profile image" height="64" width="64">\n'+
                '                   </a>\n'+
                '                   <div class="media-body mt-75">\n'+
                '                       <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">\n'+
                '                           <label>{{trans('common.Upload Photo')}}</label>\n'+
                '                           <input onchange="document.getElementById("item_image_' + itemIndex + '").src = window.URL.createObjectURL(this.files[0])" type="file" name="item_image[' + itemIndex + ']" class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer">\n'+
                '                       </div>\n'+
                '                       <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF or PNG. Max size of 2 MB</small></p>\n'+
                '                   </div>\n'+
                '               </div>\n'+
                '           </div>\n'+

                '           <div class="col-md-6">\n'+
                '               <div class="form-group">\n'+
                '                   <label for="item_price_' + itemIndex + '">{{trans('common.price')}} <span class="danger">*</span></label>\n'+
                '                   <div class="controls">\n'+
                '                       <input id="item_price_' + itemIndex + '" type="number" value="{{ isset($row) ? $row->price : old('price') }}" name="item_price[' + itemIndex + ']" class="form-control" data-validation-required-message="{{trans('common.This field is required')}}" placeholder="{{trans('common.price')}}">\n'+
                '                   </div>\n'+
                '                   @error('price')'+
                '                       <small class=" text text-danger" role="alert">\n'+
                '                           <strong>{{ $message }}</strong>\n'+
                '                       </small>\n'+
                '                   @enderror'+
                '               </div>\n'+
                '           </div>\n'+

                '           <div class="col-md-6">\n'+
                '               <div class="form-group">\n'+
                '                   <label for="item_description_' + itemIndex + '">{{trans('common.description')}} <span class="danger">*</span></label>\n'+
                '                   <div class="controls">\n'+
                '                       <input id="item_description_' + itemIndex + '" type="text" value="{{ isset($row) ? $row->description : old('description') }}" name="item_description[' + itemIndex + ']" class="form-control" data-validation-required-message="{{trans('common.This field is required')}}" placeholder="{{trans('common.description')}}">\n'+
                '                   </div>\n'+
                '                   @error('description')'+
                '                       <small class=" text text-danger" role="alert">\n'+
                '                           <strong>{{ $message }}</strong>\n'+
                '                       </small>\n'+
                '                   @enderror'+
                '               </div>\n'+
                '           </div>\n'+
                '           <div class="col-md-6">\n'+
                '               <div class="form-group">\n'+
                '                   <label for="item_status_select_' + itemIndex + '">{{trans('common.Status')}} <span class="danger">*</span></label>\n'+
                '                   <div class="controls">\n'+
                '                       <select id="item_status_select_' + itemIndex + '" class="form-control" name="item_status[' + itemIndex + ']">\n'+
                '                           @foreach($statuses as $key => $name)'+
                '                               <option value="{{ $key }}">{{ $name }}</option>\n'+
                '                           @endforeach'+
                '                       </select>\n'+
                '                   </div>\n'+
                '                   @error('status')'+
                '                       <small class=" text text-danger" role="alert">\n'+
                '                           <strong>{{ $message }}</strong>\n'+
                '                       </small>\n'+
                '                   @enderror'+
                '               </div>\n'+
                '           </div>\n'+
                '           <div class="col-sm-12 col-md-6">\n'+
                '               <div class="form-group">\n'+
                '                   <label for="item_extra_select_' + itemIndex + '">{{trans('common.itemExtra')}}</label>\n'+
                '                   <div class="controls">\n'+
                '                       <select style="width: 100%" id="item_extra_select_' + itemIndex + '" class="form-control js-example-basic-multiple js-states select2-with-clear-popup" multiple name="item_extra[' + itemIndex + '][]">\n'+
                '                           @foreach($extras as $key => $name)'+
                '                               <option value="{{ $key }}">{{ $name }}</option>\n'+
                '                           @endforeach'+
                '                       </select>\n'+
                '                   </div>\n'+
                '                   @error('item_extra')'+
                '                       <small class=" text text-danger" role="alert">\n'+
                '                           <strong>{{ $message }}</strong>\n'+
                '                       </small>\n'+
                '                   @enderror'+
                '               </div>\n'+
                '           </div>\n'+
                {{--'           <hr class="mt-2">\n'+--}}
                {{--'           <div class="col-sm-12 col-md-12 mb-4">\n'+--}}
                {{--'               <button type="button" onclick="addItemExtra(' + itemIndex + ')" class="btn btn-primary btn-sm float-right">\n'+--}}
                {{--'                   <i class="mdi mdi-plus-box"></i>\n'+--}}
                {{--'                        {{ trans('common.create item extra') }}'+--}}
                {{--'              </button>\n'+--}}
                {{--'           </div>\n'+--}}
                {{--'           <hr>\n'+--}}
                {{--'           <div class="more_item_extra_' + itemIndex + '">\n'+--}}

                {{--'           </div>\n'+--}}
                '           <div class="col-sm-12 col-md-12">\n' +
                '               <button type="button" onclick="removeItemRow(' + itemIndex + ')" class="btn btn-danger btn-sm float-right">\n' +
                '                   {{ trans('common.remove item') }}\n' +
                '               </button>\n' +
                '           </div>' +
                '       </div>' +
                '      </div>\n' +
                '    </div>\n' +
                '</div>' +
                '</div>'
            );
            $('.more_item').append(divCollapse);
            applySelect2();

            itemExtraArr[itemIndex] = 0;

            itemIndex++;
            $('#items_number').val(itemIndex);
        }

        function removeItemRow(row) {
            $('#more_item').val(itemIndex - 1);
            let itemId = 'item' + row;
            let itemDiv = document.getElementById(itemId);
            return itemDiv.parentNode.removeChild(itemDiv);
        }

        {{--function addItemExtra(itemRow) {--}}
        {{--    let title = '{{ trans('common.itemExtra') }}';--}}

        {{--    let divCollapse = $(--}}
        {{--        '<div class="col-sm-12 col-md-12 item">\n' +--}}
        {{--        '<div id="item_extra_' + itemRow + '_' + itemExtraArr[itemRow] + '" class="card accordion">\n' +--}}
        {{--        '    <div class="card-header collapsed" aria-expanded="true" data-toggle="collapse" href="#collapse' + itemRow + '_' + itemExtraArr[itemRow] + '" aria-controls="collapse' + itemRow + '_' + itemExtraArr[itemRow] + '">\n' +--}}
        {{--        '       <a class="card-title">\n' +--}}
        {{--        '          <b>' + (title) + '</b>\n' +--}}
        {{--        '        </a>\n' +--}}
        {{--        '    </div>\n' +--}}
        {{--        '\n' +--}}
        {{--        '    <div id="collapse' + itemRow + '_' + itemExtraArr[itemRow] + '" class="collapse show">\n' +--}}
        {{--        '      <div class="card-body">\n' +--}}
        {{--        '        <div class="row">' +--}}
        {{--        '           <div class="col-md-6"> \n'+--}}
        {{--        '               <div class="form-group"> \n'+--}}
        {{--        '                   <label for="item_extra_name_' + itemRow + '_' + itemExtraArr[itemRow] + '">{{trans('common.name')}}</label>\n'+--}}
        {{--        '                       <div class="controls">\n'+--}}
        {{--        '                           <input id="item_extra_name_' + itemRow + '_' + itemExtraArr[itemRow] + '" type="text" value="{{ old('name') }}" name="item_extra_name[' + itemRow + '][' + itemExtraArr[itemRow] + ']" class="form-control" data-validation-required-message="{{trans('common.This field is required')}}" placeholder="{{trans('common.Enter Name')}}">\n'+--}}
        {{--        '                       </div>\n'+--}}
        {{--        '                       @error('name')\n'+--}}
        {{--        '                           <small class=" text text-danger" role="alert">\n'+--}}
        {{--        '                               <strong>{{ $message }}</strong>\n'+--}}
        {{--        '                           </small>\n'+--}}
        {{--        '                       @enderror'+--}}
        {{--        '               </div>\n'+--}}
        {{--        '           </div>\n'+--}}

        {{--        '           <div class="col-md-6">\n'+--}}
        {{--        '               <label>{{trans('common.image')}}</label>\n'+--}}
        {{--        '               <div class="media">\n'+--}}
        {{--        '                   <a href="javascript: void(0);">\n'+--}}
        {{--        '                       <img id="item_extra_image_' + itemRow + '_' + itemExtraArr[itemRow] + '" src="{{asset('/admin_asset/app-assets/images/portrait/small/avatar-item.png')}}" class="rounded mr-75" alt="profile image" height="64" width="64">\n'+--}}
        {{--        '                   </a>\n'+--}}
        {{--        '                   <div class="media-body mt-75">\n'+--}}
        {{--        '                       <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">\n'+--}}
        {{--        '                           <label>{{trans('common.Upload Photo')}}</label>\n'+--}}
        {{--        '                           <input onchange="document.getElementById("item_extra_image_' + itemRow + '_' + itemExtraArr[itemRow] + '").src = window.URL.createObjectURL(this.files[0])" type="file" name="item_extra_image[' + itemRow + '][' + itemExtraArr[itemRow] + ']" class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer">\n'+--}}
        {{--        '                       </div>\n'+--}}
        {{--        '                       <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF or PNG. Max size of 2 MB</small></p>\n'+--}}
        {{--        '                   </div>\n'+--}}
        {{--        '               </div>\n'+--}}
        {{--        '           </div>\n'+--}}

        {{--        '           <div class="col-md-6">\n'+--}}
        {{--        '               <div class="form-group">\n'+--}}
        {{--        '                   <label for="item_extra_price_' + itemRow + '_' + itemExtraArr[itemRow] + '">{{trans('common.price')}}</label>\n'+--}}
        {{--        '                   <div class="controls">\n'+--}}
        {{--        '                       <input id="item_extra_price_' + itemRow + '_' + itemExtraArr[itemRow] + '" type="number" value="{{ old('price') }}" name="item_extra_price[' + itemRow + '][' + itemExtraArr[itemRow] + ']" class="form-control" data-validation-required-message="{{trans('common.This field is required')}}" placeholder="{{trans('common.price')}}">\n'+--}}
        {{--        '                   </div>\n'+--}}
        {{--        '                   @error('price')'+--}}
        {{--        '                       <small class=" text text-danger" role="alert">\n'+--}}
        {{--        '                           <strong>{{ $message }}</strong>\n'+--}}
        {{--        '                       </small>\n'+--}}
        {{--        '                   @enderror'+--}}
        {{--        '               </div>\n'+--}}
        {{--        '           </div>\n'+--}}

        {{--        '           <div class="col-md-6">\n'+--}}
        {{--        '               <div class="form-group">\n'+--}}
        {{--        '                   <label for="item_extra_description_' + itemRow + '_' + itemExtraArr[itemRow] + '">{{trans('common.description')}}</label>\n'+--}}
        {{--        '                   <div class="controls">\n'+--}}
        {{--        '                       <input id="item_extra_description_' + itemRow + '_' + itemExtraArr[itemRow] + '" type="text" value="{{ old('description') }}" name="item_extra_description[' + itemRow + '][' + itemExtraArr[itemRow] + ']" class="form-control" data-validation-required-message="{{trans('common.This field is required')}}" placeholder="{{trans('common.description')}}">\n'+--}}
        {{--        '                   </div>\n'+--}}
        {{--        '                   @error('description')'+--}}
        {{--        '                       <small class=" text text-danger" role="alert">\n'+--}}
        {{--        '                           <strong>{{ $message }}</strong>\n'+--}}
        {{--        '                       </small>\n'+--}}
        {{--        '                   @enderror'+--}}
        {{--        '               </div>\n'+--}}
        {{--        '           </div>\n'+--}}
        {{--        '           <hr class="mt-2">\n'+--}}
        {{--        '           <div class="col-sm-12 col-md-12">\n' +--}}
        {{--        '               <button type="button" onclick="removeItemExtraRow(' + itemRow + ', ' + itemExtraArr[itemRow] + ')" class="btn btn-danger btn-sm float-right">\n' +--}}
        {{--        '                   {{ trans('common.remove item extra') }}\n' +--}}
        {{--        '               </button>\n' +--}}
        {{--        '           </div>' +--}}
        {{--        '       </div>' +--}}
        {{--        '      </div>\n' +--}}
        {{--        '    </div>\n' +--}}
        {{--        '</div>' +--}}
        {{--        '</div>'--}}
        {{--    );--}}
        {{--    $('.more_item_extra_'+ itemRow).append(divCollapse);--}}

        {{--    itemExtraArr[itemRow] += 1;--}}
        {{--    console.log(itemExtraArr);--}}
        {{--    // $('#items_number').val(itemIndex);--}}
        {{--}--}}

        function addItemExtra(itemRow) {
            let title = '{{ trans('common.itemExtra') }}';

            let divCollapse = $(
                '<div class="col-sm-12 col-md-12 item">\n' +
                '   <div id="item_extra_' + itemRow + '_' + itemExtraArr[itemRow] + '" class="card accordion">\n' +
                '       <div class="card-header collapsed" aria-expanded="true" data-toggle="collapse" href="#collapse' + itemRow + '_' + itemExtraArr[itemRow] + '" aria-controls="collapse' + itemRow + '_' + itemExtraArr[itemRow] + '">\n' +
                '           <a class="card-title">\n' +
                '               <b>' + (title) + '</b>\n' +
                '           </a>\n' +
                '       </div>\n' +
                '       <div id="collapse' + itemRow + '_' + itemExtraArr[itemRow] + '" class="collapse show">\n' +
                '           <div class="card-body">\n' +
                '               <div class="row">' +
                '                   <div class="col-md-6"> \n'+
                '                       <div class="form-group"> \n'+
                '                           <label for="item_extra_name_' + itemRow + '_' + itemExtraArr[itemRow] + '">{{trans('common.name')}}</label>\n'+
                '                           <div class="controls">\n'+
                '                               <input id="item_extra_name_' + itemRow + '_' + itemExtraArr[itemRow] + '" type="text" value="{{ old('name') }}" name="item_extra_name[' + itemRow + '][' + itemExtraArr[itemRow] + ']" class="form-control" data-validation-required-message="{{trans('common.This field is required')}}" placeholder="{{trans('common.Enter Name')}}">\n'+
                '                           </div>\n'+
                '                           @error('name')\n'+
                '                               <small class=" text text-danger" role="alert">\n'+
                '                                   <strong>{{ $message }}</strong>\n'+
                '                               </small>\n'+
                '                           @enderror'+
                '                       </div>\n'+
                '                   </div>\n'+
                '                   <hr class="mt-2">\n'+
                '                   <div class="col-sm-12 col-md-12 float-left">\n' +
                '                       <button type="button" onclick="removeItemExtraRow(' + itemRow + ', ' + itemExtraArr[itemRow] + ')" class="btn btn-danger btn-sm float-right">\n' +
                '                           {{ trans('common.remove item extra') }}\n' +
                '                       </button>\n'+
                '                   </div>\n'+
                '               </div>\n'+
                '           </div>\n'+
            '           </div>\n'+
                '   </div>\n'+
                '</div>\n'
            );
            $('.more_item_extra_'+ itemRow).append(divCollapse);

            itemExtraArr[itemRow] += 1;
            // $('#items_number').val(itemIndex);
        }

        function removeItemExtraRow(itemRow, itemExtraRow) {
            $('#more_extra_item' + itemRow).val(itemExtraArr[itemRow] - 1);
            let itemExtraId = 'item_extra_' + itemRow + '_' + itemExtraRow;
            let itemExtraDiv = document.getElementById(itemExtraId);
            return itemExtraDiv.parentNode.removeChild(itemExtraDiv);
        }

        function applySelect2(){
            $('select.select2-with-clear-popup').select2({
                allowClear: true,
            }).on('select2:open', function () {
                var a = $(this).data('select2');
                if (!$('.select2-link-extra').length) {
                    var button = '<button id="no-results-btn" style="width: 100%" class="extra-popup btn btn-primary"  data-toggle="modal" data-target="#createExtra">'+
                        '<i class="mdi mdi-plus-box"></i>'+
                        ' Create new extra'+
                        '</button>';
                    a.$results.parents('.select2-results')
                        .append('<div class="select2-link-extra">'+button+'</div>')
                        .on('click', function (b) {
                            a.trigger('close');
                        });
                }
            });
        }

        function submitExtraFormFunction() {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "{{ route('extras.store') }}",
                data: $("#createExtraForm").serialize(),
                success: function (data) {
                    let extra = '<option value="' + data.id + '">' + data.name + '</option>';
                    var option = new Option(data.name, data.id, false, false);
                    $('.select2-with-clear-popup').append(option);
                    $('#createExtra').modal('hide');
                    $("#createExtra .close").click()

                    $('select.select2-with-clear-popup').select2({
                        allowClear: true
                    });
                }
            });
        }

        $(document).ready(function () {
            $('body').on('click', '.extra-popup', function () {
                $('select.select2-with-clear-popup').select2('close');
            });

        });
    </script>
@endsection
