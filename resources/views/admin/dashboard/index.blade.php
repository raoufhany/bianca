@extends('admin.common.index')
@section('meta')
<link rel="stylesheet" type="text/css" href="{{asset('/admin_asset/app-assets/css/pages/card-analytics.css')}}">
@endsection
@section('page_title')
Dashboard
@endsection
@section('content')
<!-- Statistics card section start -->
{{--<section id="statistics-card">--}}
{{--    <div class="row">--}}

{{--        <div class="col-lg-4 col-sm-6 col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header d-flex flex-column align-items-start pb-0">--}}
{{--                    <div class="avatar bg-rgba-primary p-50 m-0">--}}
{{--                        <div class="avatar-content">--}}
{{--                                <i class="feather icon-users text-primary font-medium-5"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <h2 class="text-bold-700 mt-1">{{ $results['users'] }}</h2>--}}
{{--                    <p class="mb-0">{{ trans('common.users') }}</p>--}}
{{--                </div>--}}
{{--                <div class="card-content">--}}
{{--                    <div id="users"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4 col-sm-6 col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header d-flex flex-column align-items-start pb-0">--}}
{{--                    <div class="avatar bg-rgba-success p-50 m-0">--}}
{{--                        <div class="avatar-content">--}}
{{--                            <i class="feather icon-user text-success font-medium-5"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <h2 class="text-bold-700 mt-1">{{ $results['drivers'] }}</h2>--}}
{{--                    <p class="mb-0">{{trans('common.drivers') }}</p>--}}
{{--                </div>--}}
{{--                <div class="card-content">--}}
{{--                    <div id="drivers"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4 col-sm-6 col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header d-flex flex-column align-items-start pb-0">--}}
{{--                    <div class="avatar bg-rgba-danger p-50 m-0">--}}
{{--                        <div class="avatar-content">--}}
{{--                            <i class="feather icon-home text-danger font-medium-5"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <h2 class="text-bold-700 mt-1">{{ $results['families'] }}</h2>--}}
{{--                    <p class="mb-0">{{ trans('common.families') }}</p>--}}
{{--                </div>--}}
{{--                <div class="card-content">--}}
{{--                    <div id="furnished_Apartment"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4 col-sm-6 col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header d-flex flex-column align-items-start pb-0">--}}
{{--                    <div class="avatar bg-rgba-warning p-50 m-0">--}}
{{--                        <div class="avatar-content">--}}
{{--                            <i class="feather icon-alert-circle text-warning font-medium-5"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <h2 class="text-bold-700 mt-1">{{ $results['pending'] }}</h2>--}}
{{--                    <p class="mb-0">{{ trans('common.Pending Orders') }}</p>--}}
{{--                </div>--}}
{{--                <div class="card-content">--}}
{{--                    <div id="furnished_Apartment"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4 col-sm-6 col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header d-flex flex-column align-items-start pb-0">--}}
{{--                    <div class="avatar bg-rgba-danger p-50 m-0">--}}
{{--                        <div class="avatar-content">--}}
{{--                            <i class="feather icon-x-square text-danger font-medium-5"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <h2 class="text-bold-700 mt-1">{{ $results['rejected'] }}</h2>--}}
{{--                    <p class="mb-0">{{ trans('common.Rejected Orders') }}</p>--}}
{{--                </div>--}}
{{--                <div class="card-content">--}}
{{--                    <div id="furnished_Apartment"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4 col-sm-6 col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header d-flex flex-column align-items-start pb-0">--}}
{{--                    <div class="avatar bg-rgba-success p-50 m-0">--}}
{{--                        <div class="avatar-content">--}}
{{--                            <i class="feather icon-check-square text-success font-medium-5"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <h2 class="text-bold-700 mt-1">{{ $results['completed'] }}</h2>--}}
{{--                    <p class="mb-0">{{ trans('common.Completed Orders') }}</p>--}}
{{--                </div>--}}
{{--                <div class="card-content">--}}
{{--                    <div id="furnished_Apartment"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="row">--}}
{{--        <div class="col-lg-4 col-sm-4 col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                  <h4 class="card-title">{{trans('common.mostCategories')}}</h4>--}}
{{--                </div>--}}
{{--                <hr>--}}
{{--                <div class="table-responsive">--}}
{{--                  <table class="table table-hover-animation">--}}
{{--                    <thead>--}}
{{--                      <tr>--}}
{{--                        <th>#</th>--}}
{{--                        <th>{{ trans('common.name') }}</th>--}}
{{--                        <th>{{ trans('common.Total Ordered') }}</th>--}}
{{--                        <th>{{ trans('common.parent') }}</th>--}}
{{--                      </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                        @foreach ($results['mostCategories'] as $index=>$row)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $index+1 }}</td>--}}
{{--                                <td>{{ $row->category->name}}</td>--}}
{{--                                <td>{{ $row->total}}</td>--}}
{{--                                <td>{{ $row->category->parent->name ?? ''}}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </tbody>--}}
{{--                  </table>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--        </div>--}}

{{--        <div class="col-lg-8 col-sm-8 col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                  <h4 class="card-title">{{trans('common.mostProducts')}}</h4>--}}
{{--                </div>--}}
{{--                <hr>--}}
{{--                <div class="table-responsive">--}}
{{--                  <table class="table table-hover-animation">--}}
{{--                    <thead>--}}
{{--                      <tr>--}}
{{--                        <th>#</th>--}}
{{--                        <th>{{ trans('common.name') }}</th>--}}
{{--                        <th>{{ trans('common.Total Ordered') }}</th>--}}
{{--                        <th>{{ trans('common.price') }}</th>--}}
{{--                        <th>{{ trans('common.category') }}</th>--}}
{{--                        <th>{{ trans('common.family') }}</th>--}}
{{--                      </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                        @foreach ($results['mostProducts'] as $index=>$row)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $index+1 }}</td>--}}
{{--                                <td>{{ $row->name }}</td>--}}
{{--                                <td>{{ $row->total }}</td>--}}
{{--                                <td>{{ $row->price }}</td>--}}
{{--                                <td>{{ $row->category->name??''}}</td>--}}
{{--                                <td>{{ $row->family->name ?? ''}}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </tbody>--}}
{{--                  </table>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</section>--}}
<!-- // Statistics Card section end-->
@endsection

@section('script')
<script src="{{asset('/admin_asset/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>

@endsection

