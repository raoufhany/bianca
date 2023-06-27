@extends('admin.common.index')
@section('page_title')
{{trans('common.'.$module_name_plural)}}
@endsection
@section('content')

<form action="" method="get">
    <div class="row match-height">
        <div class="col-xl-4 col-md-4 col-sm-4">
            <div class="form-group">
                <label>{{trans('common.search')}}</label>
                <input type="text" name="search" value="{{ $search ??'' }}" class="form-control">
            </div>
        </div>
        <div class="col-xl-2 col-md-2 col-sm-2">
            <div class="form-group">
                <label></label>
                <br>
                <input type="submit" value="{{trans('common.search')}}" class="btn btn-primary">
            </div>
        </div>
    </div>
</form>
@include('admin.partials.success')
<!-- Table Hover Animation start -->
<div class="row" id="table-hover-animation">

    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{trans('common.'.$module_name_plural)}}</h4>
          @include('admin.common.buttons.add')
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
                @foreach ($rows as $index=>$row)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $row->name}}</td>
                        <td>
                            @include('admin.common.buttons.edit')
                            @include('admin.common.buttons.delete')
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
