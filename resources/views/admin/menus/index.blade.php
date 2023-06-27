@extends('admin.common.index')
@section('page_title')
{{trans('common.menus')}}
@endsection
@section('content')

<form action="{{ route('admin.menus.index') }}" method="get">
    <div class="row match-height">
        <div class="col-xl-4 col-md-4 col-sm-4">
            <div class="form-group">
                <label>{{trans('common.search')}}</label>
                <input type="text" name="name" value="{{ request()->get('name') ?? '' }}" placeholder="{{ trans('common.menu search') }}" class="form-control">
            </div>
        </div>
        <div class="col-xl-4 col-md-4 col-sm-4 pt-2 pb-2">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{trans('common.search')}}</button>
                <a
                    href="{{ route('admin.menus.index') }}"
                    title="{{ trans('common.clear') }}"
                    class="btn btn-primary"
                    data-original-title="{{ trans('common.clear') }}"
                >
                    {{ trans('common.clear') }}
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-md-4 col-sm-4 pt-2 pb-2">
            <div class="form-group">
                <a href="{{ route('admin.categories.create') }}" title="{{trans('common.create category')}}" class="btn btn-primary"
                   data-original-title="{{trans('common.create category') }}">
                    <i class="fa fa-create"> {{trans('common.create category')}} </i>
                </a>
                <a href="{{ route('admin.items.create') }}" title="{{trans('common.create item')}}" class="btn btn-primary"
                   data-original-title="{{trans('common.create item') }}">
                    <i class="fa fa-create"> {{trans('common.create item')}} </i>
                </a>
            </div>
        </div>
    </div>
</form>

{{--<div>--}}
{{--@include('admin.common.buttons.add', ['module_name_plural' => 'categories'])--}}
{{--@include('admin.common.buttons.add', ['module_name_plural' => 'items'])--}}
{{--</div>--}}

@include('admin.partials.success')
<!-- Table Hover Animation start -->
<div class="row" id="table-hover-animation">

    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{trans('common.menus')}}</h4>
          @include('admin.common.buttons.add', ['module_name_plural' => 'menus'])
        </div>
        <hr>
        <div class="table-responsive">
          <table class="table table-hover-animation">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ trans('common.name') }}</th>
                <th>{{ trans('common.image') }}</th>
                <th>{{ trans('common.restaurant') }}</th>
                <th>{{ trans('common.Status') }}</th>
                <th>{{ trans('common.Actions') }}</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($rows as $index => $row)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>
                            <a href={{ route('admin.menus.show', $row) }}>
                                {{ $row->name}} <span class="fa fa-arrow-circle-o-right"></span>
                            </a>
                        </td>
                        <td>
                        <div class="avatar-group">
                            <div
                            data-toggle="tooltip"
                            data-popup="tooltip-custom"
                            data-placement="top"
                            title=""
                            class="avatar pull-up my-0"
                            data-original-title="{{ $row->name }}"
                            >
                            <img
                                src="{{ $row->image ? asset('images/' . $row->restaurant->name . '/menus/' . $row->image) : asset('/admin_asset/app-assets/images/portrait/small/avatar-menu.png')}}"
                                alt="Avatar"
                                height="26"
                                width="26"
                            />
                            </div>
                        </div>
                        </td>
                        <td>{{ $row->restaurant->name}}</td>
                        <td>
                            <span class="p-50 text-white badge rounded-pill {{ $row->status->is(1) ? "bg-success" : ($row->status->is(2) ? 'bg-danger' : 'bg-warning')}}">
                            {{ $row->status->description}}
                            </span>
                        </td>
                        <td>
                            <a href="{{route('admin.menus.change-status', $row)}}" title="{{trans('common.change status')}}" class="btn btn-primary btn-sm"
                               data-original-title="{{trans('common.change status') }}">
                                <i class="fa fa-edit"> {{trans('common.change status')}} </i>
                            </a>
                            @include('admin.common.buttons.edit', ['module_name_plural' => 'menus'])
                            @include('admin.common.buttons.delete', ['module_name_plural' => 'menus'])
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Table head options end -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center mt-3">
        {{ $rows->links() }}
    </ul>
</nav>
<!-- // Basic example and Profile cards section end -->
@endsection

@section('script')
<script>
$(document).on('click', '.delete-ajax', function() {
    var url = $(this).data('url');
    var direct = $(this).data('direct');
    Swal.fire({
        title: "{{trans('common.Are you sure?')}}",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "{{trans('common.Yes, delete it')}}"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: url,
                success: function(data){
                    Swal.fire({
                        icon: 'success',
                        title: "{{trans('common.Deleted Successfully')}}",
                        showConfirmButton: false
                    })
                    setTimeout(function () {
                        window.location.href = direct;
                    }, 2000);
                }
            });
        }
    })
})
</script>
@endsection
