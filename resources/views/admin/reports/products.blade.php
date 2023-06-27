@extends('admin.common.index')
@section('meta')
<link rel="stylesheet" type="text/css" href="{{asset('/admin_asset/app-assets/css/pages/card-analytics.css')}}">
@endsection
@section('page_title')
{{ trans('common.ProductsOrdered') }}
@endsection
@section('content')

<!-- Statistics card section start -->
<form action="" method="get">
    <div class="row match-height">
        <div class="col-xl-4 col-md-4 col-sm-4">
            <div class="form-group">
                <label>{{trans('common.search')}}</label>
                <input type="text" name="search" value="{{ old('search', request()->get('search')) }}" class="form-control">
            </div>
        </div>
        <div class="col-xl-4 col-md-4 col-sm-4">

            <label>{{trans('common.Date')}}</label>

            <input class="form-control" id="reportrange" type="text" name="date" value="{{ old('date', request()->get('date')) }}" />
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


<section id="statistics-card">

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                  <h4 class="card-title">{{trans('common.ProductsOrdered')}}</h4>
                </div>
                <hr>
                <div class="table-responsive">
                  <table class="table table-hover-animation">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>{{ trans('common.name') }}</th>
                        <th>{{ trans('common.price') }}</th>
                        <th>{{ trans('common.Total Ordered') }}</th>
                        <th>{{ trans('common.category') }}</th>
                        <th>{{ trans('common.family') }}</th>
                        <th>{{ trans('common.Date') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index=>$row)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->price }}</td>
                                <td>{{ $row->total }}</td>
                                <td>{{ $row->category->name??''}}</td>
                                <td>{{ $row->family->name ?? ''}}</td>
                                <td>{{ reportDateFormat($row->date)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
        </div>

    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center mt-3">
            {{ $products->links() }}
        </ul>
    </nav>
</section>
<!-- // Statistics Card section end-->
@endsection

@section('script')
<script src="{{asset('/admin_asset/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });
</script>
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@endsection
