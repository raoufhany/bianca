@if (auth()->user()->canAny([$module_name_plural.'-delete', 'general-all']))
<form action="{{route('admin.'.$module_name_plural.'.destroy', $row)}}" method="POST" style="display: inline-block">
    {{csrf_field()}}
    {{method_field('DELETE')}}

    <button type="submit" title="{{trans('common.Delete')}}" class="btn btn-danger btn-sm delete" data-original-title="{{trans('common.Delete')}}">
        <i class="fa fa-times"> {{trans('common.Delete')}}</i>
    </button>
</form>
@else
<button class="btn btn-dark btn-sm"> <i class="fa fa-times"> {{trans('common.Delete')}}</i></button>
@endif
