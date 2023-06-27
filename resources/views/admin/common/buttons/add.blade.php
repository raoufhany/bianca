@if (auth()->user()->canAny([$module_name_plural.'-create', 'general-all']) && session()->has('restaurant'))
<a href="{{ route('admin.'.$module_name_plural.'.create', ['main' => session()->get('mainCategory')]) }}" title="{{trans('common.Create')}}" class="btn btn-primary btn-lg"
    data-original-title="{{trans('common.Create') }}">
    <i class="fa fa-create"> {{trans('common.Create')}} </i>
</a>
@else
<button type="button" class="btn btn-dark btn-outline-primary" disabled>  <i class="fa fa-create"> {{trans('common.create')}} </i> </button>
@endif
