@extends('admin.common.index')
@section('meta')
<link rel="stylesheet" type="text/css" href="{{asset('/admin_asset/app-assets/css/plugins/forms/validation/form-validation.css')}}">
@endsection
@section('page_title')
{{trans('common.create item')}}
@endsection
@section('content')

@include('admin.common.extra_popup')

@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <p class="mb-0">
        {{session()->get('error')}}
    </p>
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
                    <h4 class="card-title">{{trans('common.create item')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form-horizontal" novalidate
                            action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data">
                            @include('admin.items.form')
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

    <script type="text/javascript">

        $('#restaurantSelect').on('change', function () {
            let restaurant_id = $(this).val();
            getMenus(restaurant_id);
        });

        function getMenus(restaurant_id){
            let menu = $('#adminMenuSelect');
            menu.find('option').remove().end();
            $.ajax({
                type: "GET",
                url: "{{ route('restaurant.menus') }}",
                data: {
                    id: restaurant_id
                },
                success: function (data) {
                    menu.html('<option value="">-- {{trans('common.select menu')}} --</option>');
                    $.each(data, function(id, value){
                        menu.append('<option value="'+id+'">'+value+'</option>');
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
                    var option = new Option(data.name, data.id, true, true);
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

            $('body').on('click', '.extra-popup', function () {
                $('select.select2-with-clear-popup').select2('close');
            });

        });
    </script>
@endsection
