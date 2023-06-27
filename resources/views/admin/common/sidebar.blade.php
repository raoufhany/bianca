<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="#">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">SPLIT</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class=" nav-item {{request()->is('admin') ? 'sidebar-group-active open' : ''}}">
                <a href="index.html">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="Dashboard">{{trans('common.Dashboard')}}</span><span class="badge badge badge-warning badge-pill float-right mr-2">1</span>
                </a>
                <ul class="menu-content">
                    <li class="{{request()->is('admin') ? 'active' : ''}}">
                        <a href="{{route('admin.dashboard')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">Analytics</span></a>
                    </li>
                    {{-- <li>
                        <a href="{{route('admin.dashboard_v2')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">Pillow</span></a>
                    </li> --}}
                </ul>
            </li>

            @if(auth()->user()->canAny(['menus-index', 'menus-create', 'general-all']))
            <li class="nav-item
            {{setMenu('menus/')}}
            ">
                <a href="#">
                    <i class="feather icon-menu"></i>
                    <span class="menu-title" data-i18n="Menu">{{trans('common.menus')}}</span>
                </a>
                <ul class="menu-content">
                    @if(auth()->user()->canAny(['menus-index', 'general-all']) )
                        <li class="
                        {{setShown('menus/')}}
                        {{setActive('menus')}}
                        ">
                            <a href="{{route('admin.menus.index')}}">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="List">{{trans('common.List')}}</span>
                            </a>
                        </li>
                    @endif
{{--                    @if(auth()->user()->canAny(['menus-create', 'general-all']) && session()->has('restaurant'))--}}
{{--                        <li class="--}}
{{--                        {{setShown('menus/')}}--}}
{{--                        {{setActive('menus/create')}}--}}
{{--                        ">--}}
{{--                            <a href="{{route('admin.menus.create')}}">--}}
{{--                                <i class="feather icon-circle"></i>--}}
{{--                                <span class="menu-item" data-i18n="Create">{{trans('common.Add')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
                        @if(auth()->user()->canAny(['categories-index', 'categories-create', 'general-all']))
                            <li class="
                            {{setMenu('categories/')}}
                            {{setShown('categories/')}}
                            {{setActive('categories')}}
                            ">
                                <a href="{{route('admin.categories.index')}}">
                                    <i class="feather icon-list"></i>
                                    <span class="menu-title" data-i18n="Item">{{trans('common.categories')}}</span>
                                </a>
{{--                                <ul class="menu-content">--}}
{{--                                    @if(auth()->user()->canAny(['categories-index', 'general-all']) )--}}
{{--                                        <li class="--}}
{{--                                        {{setShown('categories/')}}--}}
{{--                                        {{setActive('categories')}}--}}
{{--                                        ">--}}
{{--                                            <a href="{{route('admin.categories.index')}}">--}}
{{--                                                <i class="feather icon-circle"></i>--}}
{{--                                                <span class="menu-item" data-i18n="List">{{trans('common.List')}}</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endif--}}
{{--                                    @if(auth()->user()->canAny(['items-create', 'general-all']) && session()->has('restaurant'))--}}
{{--                                        <li class="--}}
{{--                                        {{setShown('items/')}}--}}
{{--                                        {{setActive('items/create')}}--}}
{{--                                        ">--}}
{{--                                            <a href="{{route('admin.items.create')}}">--}}
{{--                                                <i class="feather icon-circle"></i>--}}
{{--                                                <span class="menu-item" data-i18n="Create">{{trans('common.Add')}}</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endif--}}
{{--                                </ul>--}}
                            </li>
                    @endif
                    @if(auth()->user()->canAny(['items-index', 'items-create', 'general-all']))
                        <li class="
                            {{setMenu('items/')}}
                            {{setShown('items/')}}
                            {{setActive('items')}}
                        ">
                                <a href="{{route('admin.items.index')}}">
                                    <i class="feather icon-info"></i>
                                    <span class="menu-title" data-i18n="Item">{{trans('common.items')}}</span>
                                </a>
{{--                                <ul class="menu-content">--}}
{{--                                    @if(auth()->user()->canAny(['items-index', 'general-all']) )--}}
{{--                                        <li class="--}}
{{--                                        {{setShown('items/')}}--}}
{{--                                        {{setActive('items')}}--}}
{{--                                        ">--}}
{{--                                            <a href="{{route('admin.items.index')}}">--}}
{{--                                                <i class="feather icon-circle"></i>--}}
{{--                                                <span class="menu-item" data-i18n="List">{{trans('common.List')}}</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endif--}}
{{--                                    @if(auth()->user()->canAny(['items-create', 'general-all']) && session()->has('restaurant'))--}}
{{--                                        <li class="--}}
{{--                                        {{setShown('items/')}}--}}
{{--                                        {{setActive('items/create')}}--}}
{{--                                        ">--}}
{{--                                            <a href="{{route('admin.items.create')}}">--}}
{{--                                                <i class="feather icon-circle"></i>--}}
{{--                                                <span class="menu-item" data-i18n="Create">{{trans('common.Add')}}</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endif--}}
{{--                                </ul>--}}
                        </li>
                    @endif
                </ul>
            </li>
            @endif

{{--            @if(auth()->user()->canAny(['item-extras-index', 'item-extras-create', 'general-all']))--}}
{{--                <li class="nav-item--}}
{{--                    {{setMenu('item-extras/')}}--}}
{{--                    {{setShown('item-extras/')}}--}}
{{--                    {{setActive('item-extras')}}--}}
{{--                ">--}}
{{--                    <a href="{{route('admin.item-extras.index')}}">--}}
{{--                        <i class="feather icon-plus"></i>--}}
{{--                        <span class="menu-title" data-i18n="ItemExtra">{{trans('common.itemExtras')}}</span>--}}
{{--                    </a>--}}
{{--                    <ul class="menu-content">--}}
{{--                        @if(auth()->user()->canAny(['item-extras-index', 'general-all']) )--}}
{{--                            <li class="--}}
{{--                        {{setShown('item-extras/')}}--}}
{{--                        {{setActive('item-extras')}}--}}
{{--                        ">--}}
{{--                                <a href="{{route('admin.item-extras.index')}}">--}}
{{--                                    <i class="feather icon-circle"></i>--}}
{{--                                    <span class="menu-item" data-i18n="List">{{trans('common.List')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                        @if(auth()->user()->canAny(['item-extras-create', 'general-all']) && session()->has('restaurant'))--}}
{{--                            <li class="--}}
{{--                        {{setShown('item-extras/')}}--}}
{{--                        {{setActive('item-extras/create')}}--}}
{{--                        ">--}}
{{--                                <a href="{{route('admin.item-extras.create')}}">--}}
{{--                                    <i class="feather icon-circle"></i>--}}
{{--                                    <span class="menu-item" data-i18n="Create">{{trans('common.Add')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endif--}}

            @if(auth()->user()->canAny(['tables-index', 'tables-create', 'general-all']))
                <li class="nav-item
            {{setMenu('tables/')}}
            ">
                    <a href="#">
                        <i class="feather icon-list"></i>
                        <span class="menu-title" data-i18n="Table">{{trans('common.tables')}}</span>
                    </a>
                    <ul class="menu-content">
                        @if(auth()->user()->canAny(['tables-index', 'general-all']) )
                            <li class="
                        {{setShown('tables/')}}
                        {{setActive('tables')}}
                        ">
                                <a href="{{route('admin.tables.index')}}">
                                    <i class="feather icon-circle"></i>
                                    <span class="menu-item" data-i18n="List">{{trans('common.List')}}</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->canAny(['tables-create', 'general-all']) && session()->has('restaurant'))
                            <li class="
                        {{setShown('tables/')}}
                        {{setActive('tables/create')}}
                        ">
                                <a href="{{route('admin.tables.create')}}">
                                    <i class="feather icon-circle"></i>
                                    <span class="menu-item" data-i18n="Create">{{trans('common.Add')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

{{--            @if(auth()->user()->can('family-list') || auth()->user()->can('family-create'))--}}
{{--                <li class="nav-item--}}
{{--            {{setMenu('admin.family')}}--}}
{{--            ">--}}
{{--                    <a href="#">--}}
{{--                        <i class="feather icon-user"></i>--}}
{{--                        <span class="menu-title" data-i18n="User">{{trans('common.families')}}</span>--}}
{{--                    </a>--}}
{{--                    <ul class="menu-content">--}}
{{--                        @if(auth()->user()->can('family-list') )--}}
{{--                            <li class="--}}
{{--                        {{setShown('admin.family')}}--}}
{{--                        {{setActive('admin.family')}}--}}
{{--                        ">--}}
{{--                                <a href="{{route('admin.families.index')}}">--}}
{{--                                    <i class="feather icon-circle"></i>--}}
{{--                                    <span class="menu-item" data-i18n="List">{{trans('common.List')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                        @if(auth()->user()->can('family-create'))--}}
{{--                            <li class="--}}
{{--                        {{setShown('admin.family')}}--}}
{{--                        {{setActive('admin.family')}}--}}
{{--                        ">--}}
{{--                                <a href="{{route('admin.families.create')}}">--}}
{{--                                    <i class="feather icon-circle"></i>--}}
{{--                                    <span class="menu-item" data-i18n="Edit">{{trans('common.Add')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endif--}}

{{--            @if(auth()->user()->can('category-list') || auth()->user()->can('category-create'))--}}
{{--            <li class="nav-item--}}
{{--            {{setMenu('admin.drivers')}}--}}
{{--            ">--}}
{{--                <a href="#">--}}
{{--                    <i class="feather icon-user"></i>--}}
{{--                    <span class="menu-title" data-i18n="User">{{trans('common.Maincategories')}}</span>--}}
{{--                </a>--}}
{{--                <ul class="menu-content">--}}
{{--                    @if(auth()->user()->can('category-list') )--}}
{{--                        <li class="--}}
{{--                        {{setShown('admin.categories')}}--}}
{{--                        {{setActive('admin.categories')}}--}}
{{--                        ">--}}
{{--                            <a href="{{route('admin.categories.index',['main'=>true])}}">--}}
{{--                                <i class="feather icon-circle"></i>--}}
{{--                                <span class="menu-item" data-i18n="List">{{trans('common.List')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                    @if(auth()->user()->can('category-create'))--}}
{{--                        <li class="--}}
{{--                        {{setShown('admin.categories')}}--}}
{{--                        {{setActive('admin.categories')}}--}}
{{--                        ">--}}
{{--                            <a href="{{route('admin.categories.create',['main'=>true])}}">--}}
{{--                                <i class="feather icon-circle"></i>--}}
{{--                                <span class="menu-item" data-i18n="Edit">{{trans('common.Add')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            @endif--}}

{{--            @if(auth()->user()->can('category-list') || auth()->user()->can('category-create'))--}}
{{--            <li class="nav-item--}}
{{--            {{setMenu('admin.drivers')}}--}}
{{--            ">--}}
{{--                <a href="#">--}}
{{--                    <i class="feather icon-user"></i>--}}
{{--                    <span class="menu-title" data-i18n="User">{{trans('common.Subcategories')}}</span>--}}
{{--                </a>--}}
{{--                <ul class="menu-content">--}}
{{--                    @if(auth()->user()->can('category-list') )--}}
{{--                        <li class="--}}
{{--                        {{setShown('admin.categories')}}--}}
{{--                        {{setActive('admin.categories')}}--}}
{{--                        ">--}}
{{--                            <a href="{{route('admin.categories.index',['main'=>false])}}">--}}
{{--                                <i class="feather icon-circle"></i>--}}
{{--                                <span class="menu-item" data-i18n="List">{{trans('common.List')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                    @if(auth()->user()->can('category-create'))--}}
{{--                        <li class="--}}
{{--                        {{setShown('admin.categories')}}--}}
{{--                        {{setActive('admin.categories')}}--}}
{{--                        ">--}}
{{--                            <a href="{{route('admin.categories.create',['main'=>false])}}">--}}
{{--                                <i class="feather icon-circle"></i>--}}
{{--                                <span class="menu-item" data-i18n="Edit">{{trans('common.Add')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            @endif--}}

{{--            @if(auth()->user()->can('report-list') || auth()->user()->can('report-create'))--}}
{{--            <li class="nav-item--}}
{{--            {{setMenu('admin.drivers')}}--}}
{{--            ">--}}
{{--                <a href="#">--}}
{{--                    <i class="feather icon-zap"></i>--}}
{{--                    <span class="menu-title" data-i18n="User">{{trans('common.reports')}}</span>--}}
{{--                </a>--}}
{{--                <ul class="menu-content">--}}
{{--                    @if(auth()->user()->can('report-list') )--}}
{{--                        <li class="--}}
{{--                        {{setShown('admin.reports')}}--}}
{{--                        {{setActive('admin.reports')}}--}}
{{--                        ">--}}
{{--                            <a href="{{route('admin.reports.products')}}">--}}
{{--                                <i class="feather icon-circle"></i>--}}
{{--                                <span class="menu-item" data-i18n="List">{{trans('common.ProductsOrdered')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="--}}
{{--                        {{setShown('admin.reports')}}--}}
{{--                        {{setActive('admin.reports')}}--}}
{{--                            ">--}}
{{--                            <a href="{{route('admin.reports.orders')}}">--}}
{{--                                <i class="feather icon-circle"></i>--}}
{{--                                <span class="menu-item" data-i18n="List">{{trans('common.Orders')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="--}}
{{--                        {{setShown('admin.reports')}}--}}
{{--                        {{setActive('admin.reports')}}--}}
{{--                            ">--}}
{{--                            <a href="{{route('admin.reports.users')}}">--}}
{{--                                <i class="feather icon-circle"></i>--}}
{{--                                <span class="menu-item" data-i18n="List">{{trans('common.users')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="--}}
{{--                        {{setShown('admin.reports')}}--}}
{{--                        {{setActive('admin.reports')}}--}}
{{--                            ">--}}
{{--                            <a href="{{route('admin.reports.families')}}">--}}
{{--                                <i class="feather icon-circle"></i>--}}
{{--                                <span class="menu-item" data-i18n="List">{{trans('common.families')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                    @if(auth()->user()->can('report-list') )--}}
{{--                        <li class="--}}
{{--                        {{setShown('admin.reports')}}--}}
{{--                        {{setActive('admin.reports')}}--}}
{{--                        ">--}}
{{--                            <a href="{{route('admin.reports.drivers')}}">--}}
{{--                                <i class="feather icon-circle"></i>--}}
{{--                                <span class="menu-item" data-i18n="List">{{trans('common.drivers')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}

{{--                </ul>--}}
{{--            </li>--}}
{{--            @endif--}}

{{--            @if(auth()->user()->can('user-list') || auth()->user()->can('user-create'))--}}
{{--            <li class="nav-item--}}
{{--            {{setMenu('admin.users')}}--}}
{{--            ">--}}
{{--                <a href="#">--}}
{{--                    <i class="feather icon-user"></i>--}}
{{--                    <span class="menu-title" data-i18n="User">{{trans('common.users')}}</span>--}}
{{--                </a>--}}
{{--                <ul class="menu-content">--}}
{{--                    @if(auth()->user()->can('user-list') )--}}
{{--                        <li class="--}}
{{--                        {{setShown('admin.users')}}--}}
{{--                        {{setActive('admin.users')}}--}}
{{--                        ">--}}
{{--                            <a href="{{route('admin.users.index')}}">--}}
{{--                                <i class="feather icon-circle"></i>--}}
{{--                                <span class="menu-item" data-i18n="List">{{trans('common.List')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                    @if(auth()->user()->can('user-create'))--}}
{{--                        <li class="--}}
{{--                        {{setShown('admin.users')}}--}}
{{--                        {{setActive('admin.users')}}--}}
{{--                        ">--}}
{{--                            <a href="{{route('admin.users.create')}}">--}}
{{--                                <i class="feather icon-circle"></i>--}}
{{--                                <span class="menu-item" data-i18n="Edit">{{trans('common.Add')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            @endif--}}

{{--            @if(auth()->user()->can('order-list') || auth()->user()->can('order-create'))--}}
{{--                <li class="nav-item--}}
{{--            {{setMenu('admin.orders')}}--}}
{{--            ">--}}
{{--                    <a href="#">--}}
{{--                        <i class="feather icon-user"></i>--}}
{{--                        <span class="menu-title" data-i18n="User">{{trans('common.orders')}}</span>--}}
{{--                    </a>--}}
{{--                    <ul class="menu-content">--}}
{{--                        @if(auth()->user()->can('order-list') )--}}
{{--                            <li class="--}}
{{--                        {{setShown('admin.orders')}}--}}
{{--                        {{setActive('admin.orders')}}--}}
{{--                        ">--}}
{{--                                <a href="{{route('admin.orders.index')}}">--}}
{{--                                    <i class="feather icon-circle"></i>--}}
{{--                                    <span class="menu-item" data-i18n="List">{{trans('common.List')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endif--}}

{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endif--}}

            {{-- @if(1)
            <li class="nav-item
            {{setMenu('admin.roles')}}
            ">
                <a href="#">
                    <i class="feather icon-user"></i>
                    <span class="menu-title" data-i18n="User">{{trans('common.roles')}}</span>
                </a>
                <ul class="menu-content">
                    @if(1)
                        <li class="
                        {{setShown('admin.roles')}}
                        {{setActive('admin.roles')}}
                        ">
                            <a href="{{route('admin.roles.index')}}">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="List">{{trans('common.List')}}</span>
                            </a>
                        </li>
                    @endif
                    @if(1)
                        <li class="
                        {{setShown('admin.roles')}}
                        {{setActive('admin.roles')}}
                        ">
                            <a href="{{route('admin.roles.create')}}">
                                <i class="feather icon-circle"></i>
                                <span class="menu-item" data-i18n="Edit">{{trans('common.Add')}}</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            @endif --}}

{{--            <li class="nav-item--}}
{{--            {{setMenu('admins')}}--}}
{{--            ">--}}
{{--                <a href="#">--}}
{{--                    <i class="feather icon-user"></i>--}}
{{--                    <span class="menu-title" data-i18n="User">{{trans('common.admins')}}</span>--}}
{{--                </a>--}}
{{--                <ul class="menu-content">--}}
{{--                    @if(auth()->user()->can('role-list'))--}}
{{--                        <li class="--}}
{{--                        {{setShown('roles')}}--}}
{{--                        {{setActive('roles')}}--}}
{{--                        ">--}}
{{--                            <a href="{{route('admin.roles.index')}}">--}}
{{--                                <i class="feather icon-circle"></i>--}}
{{--                                <span class="menu-item" data-i18n="List">{{trans('common.roles')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                    @if(auth()->user()->can('admin-list'))--}}
{{--                        <li class="--}}
{{--                        {{setShown('admins')}}--}}
{{--                        {{setActive('admins')}}--}}
{{--                        ">--}}
{{--                            <a href="{{route('admin.admins.index')}}">--}}
{{--                                <i class="feather icon-circle"></i>--}}
{{--                                <span class="menu-item" data-i18n="Edit">{{trans('common.admins')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--            </li>--}}

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
