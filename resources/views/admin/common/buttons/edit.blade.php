@if (auth()->user()->canAny([$module_name_plural.'-edit', 'general-all']) && session()->has('restaurant'))
<a href="{{route('admin.'.$module_name_plural.'.edit', $row)}}" title="{{trans('common.Edit')}}" class="btn btn-info btn-sm"
    data-original-title="{{trans('common.Edit') }}">
    <i class="fa fa-edit"> {{trans('common.Edit')}} </i>
</a>
@else
<a href="javascript:void(0)" title="{{trans('common.Edit')}}" class="btn btn-dark btn-sm" style="pointer-events: none">
    <i class="fa fa-edit"> {{trans('common.edit')}} </i>
</a>
@endif
