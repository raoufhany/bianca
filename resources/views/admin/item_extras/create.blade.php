@extends('admin.common.index')
@section('meta')
<link rel="stylesheet" type="text/css" href="{{asset('/admin_asset/app-assets/css/plugins/forms/validation/form-validation.css')}}">
@endsection
@section('page_title')
{{trans('common.create item extra')}}
@endsection
@section('content')

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
                    <h4 class="card-title">{{trans('common.create item extra')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form-horizontal" novalidate
                            action="{{ route('admin.item-extras.store') }}" method="POST" enctype="multipart/form-data">
                            @include('admin.item_extras.form')
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

        $('#adminMenuSelect').on('change', function () {
            let menu_id = $(this).val();
            getItems(menu_id);
        });

        $('#menuSelect').on('change', function () {
            let menu_id = $(this).val();
            getItems(menu_id);
        });

        function getItems(menu_id){
            let item = $('#itemSelect');
            item.find('option').remove().end();
            $.ajax({
                type: "GET",
                url: "{{ route('menu.items') }}",
                data: {
                    id: menu_id
                },
                success: function (data) {
                    item.html('<option value="">-- {{trans('common.select item')}} --</option>');
                    $.each(data, function(id, value){
                        item.append('<option value="'+id+'">'+value+'</option>');
                    });
                }
            });
        }
    </script>
@endsection
