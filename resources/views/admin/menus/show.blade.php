@extends('admin.common.index')
@section('page_title')
{{trans('common.menu management')}}
@endsection
@section('content')

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
          <h4 class="card-title">{{trans('common.menu management')}}</h4>
          @include('admin.common.buttons.edit', ['module_name_plural' => 'menus'])
        </div>
        <hr>
      </div>
    </div>
</div>

<div class="row" id="table-hover-animation">
    <div class="col-12">
        <div class="card" style="overflow-x: auto;">
            <div class="row flex-row flex-nowrap mt-2 pl-1 pb-2 pt-2">
                  @foreach($menus as $key => $name)
                  <div class="col-4">
                      <div class="card card-block">
                          <a href="{{ route('admin.menus.show', $key) }}" title="{{trans('common.Create')}}" class="btn btn-primary btn-lg"
                             data-original-title="{{trans('common.Create') }}">
                              {{ $name }}
                          </a>
                      </div>
                  </div>
                  @endforeach

                  <div class="col-2">
                      <div class="card card-block">
                          <a href="{{ route('admin.menus.create', ['main' => session()->get('mainCategory')]) }}" title="{{trans('common.Create')}}" class="btn btn-primary btn-lg"
                             data-original-title="{{trans('common.Create') }}">
                              <i class="fa fa-plus"> </i>
                          </a>
                      </div>
                  </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="table-hover-animation">
    <div class="col-12">
        @foreach ($row->categories as $category)
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $category->name }}</h4>
                    <div class="row">
                        <span class="p-50 mr-1 text-white badge rounded-pill bg-secondary">
                            {{ $category->position}}
                        </span>
                        <span class="p-50 mr-1 text-white badge rounded-pill {{ $category->status->is(1) ? "bg-success" : ($category->status->is(2) ? 'bg-danger' : 'bg-warning')}}">
                            {{ $category->status->description}}
                        </span>
                        @include('admin.common.buttons.edit', ['module_name_plural' => 'categories', 'row' => $category])
                    </div>
                </div>
                <hr>
                <div class="row" id="table-hover-animation">
                    <div class="col-12">
                        <div style="position: relative; height: 330px; overflow: auto; display: block;">
                            <table class="table table-bordered table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('common.name') }}</th>
                                    <th>{{ trans('common.description') }}</th>
                                    <th>{{ trans('common.price') }}</th>
                                    <th>{{ trans('common.Status') }}</th>
                                    <th>{{ trans('common.Actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($category->items as $index => $item)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $item->name}}</td>
                                        <td>{{ $item->description}}</td>
                                        <td>{{ $item->price}}</td>
                                        <td>
                                                <span class="p-50 text-white badge rounded-pill {{ $item->status->is(1) ? "bg-success" : ($item->status->is(2) ? 'bg-danger' : 'bg-warning')}}">
                                                {{ $item->status->description}}
                                                </span>
                                        </td>
                                        <td>
                                            @include('admin.common.buttons.edit', ['module_name_plural' => 'items', 'row' => $item])
                                            @include('admin.common.buttons.delete', ['module_name_plural' => 'items', 'row' => $item])
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
  <!-- Table head options end -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center mt-3">
{{--        {{ $rows->links() }}--}}
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
