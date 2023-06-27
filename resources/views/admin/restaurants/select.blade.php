@extends('admin.common.index')
@section('page_title')
{{trans('common.restaurants')}}
@endsection
@section('content')

<!-- Table Hover Animation start -->
<div class="row" id="table-hover-animation">

    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{trans('common.select restaurant')}}</h4>
            @if (session()->has('restaurant'))
                <a href="{{ route('admin.restaurant-unselect') }}" title="{{trans('common.unselect restaurant')}}" class="btn btn-primary "
                   data-original-title="{{trans('common.unselect restaurant') }}">
                    <i class="fa fa-trash"> {{trans('common.unselect restaurant')}} </i>
                </a>
            @endif
        </div>
        <hr>
        <div class="table-responsive">
          <table class="table table-hover-animation">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ trans('common.name') }}</th>
                <th>{{ trans('common.Actions') }}</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($rows as $index => $row)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $row->name}}</td>
                        <td>
                            <a href="{{route('admin.restaurant-select', $row)}}" title="{{trans('common.select restaurant')}}" class="btn btn-info btn-sm"
                               data-original-title="{{trans('common.select restaurant') }}">
                                <i class="fa fa-send"> {{trans('common.select restaurant')}} </i>
                            </a>
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
