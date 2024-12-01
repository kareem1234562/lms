<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row justify-content-center">
            <img src="{{getSettingImageLink('logo_light')}}" height="55" />
            <!-- <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li> -->
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="@if(isset($active) && $active == 'panelHome') active @endif nav-item" >
                <a class="d-flex align-items-center" href="{{route('admin.index')}}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.PanelHome')}}">
                        {{trans('common.PanelHome')}}
                    </span>
                </a>
            </li>
            @if(userCan('view_settings'))
                <li class="nav-item @if(isset($active) && $active == 'setting') active @endif">
                    <a class="d-flex align-items-center" href="{{route('admin.settings.general')}}">
                        <i data-feather='settings'></i>
                        <span class="menu-title text-truncate" data-i18n="{{trans('common.setting')}}">
                            {{trans('common.setting')}}
                        </span>
                    </a>
                </li>
            @endif
            @if(userCan('users_view') || userCan('roles_view'))
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather="shield"></i>
                        <span class="menu-title text-truncate" data-i18n="{{trans('common.UsersManagment')}}">
                            {{trans('common.UsersManagment')}}
                        </span>
                    </a>
                    <ul class="menu-content">
                        @if(userCan('users_view'))
                            <li @if(isset($active) && $active == 'adminUsers') class="active" @endif>
                                <a class="d-flex align-items-center" href="{{route('admin.adminUsers')}}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="{{trans('common.AdminUsers')}}">
                                        {{trans('common.users')}}
                                    </span>
                                </a>
                            </li>
                        @endif
                        @if(userCan('instructors_view'))
                            <li @if(isset($active) && $active == 'instructors') class="active" @endif>
                                <a class="d-flex align-items-center" href="{{route('admin.courses.instructors')}}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="{{trans('learning.instructors')}}">
                                        {{trans('learning.instructors')}}
                                    </span>
                                </a>
                            </li>
                        @endif
                        @if(userCan('clients_view'))
                            <li @if(isset($active) && $active == 'clients') class="active" @endif>
                                <a class="d-flex align-items-center" href="{{route('admin.clients')}}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="{{trans('common.clients')}}">
                                        {{trans('common.clients')}}
                                    </span>
                                </a>
                            </li>
                        @endif
                        @if(userCan('roles_view'))
                            <li @if(isset($active) && $active == 'roles') class="active" @endif>
                                <a class="d-flex align-items-center" href="{{route('admin.roles')}}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="{{trans('common.Roles')}}">
                                        {{trans('common.Roles')}}
                                    </span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(userCan('countries_view'))
                <li class="nav-item @if(isset($active) && $active == 'countries') active @endif">
                    <a class="d-flex align-items-center" href="{{route('admin.countries.index')}}">
                        <i data-feather='git-branch'></i>
                        <span class="menu-title" data-i18n="{{trans('learning.countries&unis&curriculums')}}">
                            {{trans('learning.countries&unis&curriculums')}}
                        </span>
                    </a>
                </li>
            @endif

            @if(userCan('courses_view') || userCan('courses_bundles_view') || userCan('courses_groups_view'))
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#">
                        <i data-feather='archive'></i>
                        <span class="menu-title text-truncate" data-i18n="{{trans('common.courses')}}">
                            الدورات التدريبية
                        </span>
                    </a>
                    <ul class="menu-content">
                        @if(userCan('courses_view'))
                            <li @if(isset($active) && $active == 'courses') class="active" @endif>
                                <a class="d-flex align-items-center" href="{{route('admin.courses')}}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="{{trans('common.courses')}}">
                                        الدورات التدريبية
                                    </span>
                                </a>
                            </li>
                        @endif
                        @if(userCan('courses_schedule_view'))
                            <li @if(isset($active) && $active == 'courses_schedule') class="active" @endif>
                                <a class="d-flex align-items-center" href="{{route('admin.courses.schedule')}}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="{{trans('common.courses_schedule')}}">
                                        الجدول الأسبوعي
                                    </span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif






            @if(userCan('courses_view'))
                            <li @if(isset($active) && $active == 'new courses') class="active" @endif>
                                <a class="d-flex align-items-center" href="{{route('admin.newCourse')}}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="{{trans('common.courses')}}">
                                        الدورات التدريبية الجديدة
                                    </span>
                                </a>
                            </li>
                        @endif






            @if(userCan('pages_view'))
                <li class="nav-item @if(isset($active) && $active == 'pages') active @endif">
                    <a class="d-flex align-items-center" href="{{route('admin.pages.index')}}">
                        <i data-feather='list'></i>
                        <span class="menu-title" data-i18n="{{trans('common.pages')}}">
                            {{trans('common.pages')}}
                        </span>
                    </a>
                </li>
            @endif
            @if(userCan('coins_questions_view'))
                <li class="nav-item @if(isset($active) && $active == 'coins_questions') active @endif">
                    <a class="d-flex align-items-center" href="{{route('admin.coins_questions.index')}}">
                        <i data-feather='list'></i>
                        <span class="menu-title" data-i18n="{{trans('learning.coins_questions')}}">
                            {{trans('learning.coins_questions')}}
                        </span>
                    </a>
                </li>
            @endif

            {{-- <li class="nav-item @if(isset($active) && $active == 'transactionsRequests') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.transactionsRequests')}}">
                    <i data-feather='list'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.transactionsRequests')}}">
                        {{trans('common.transactionsRequests')}}
                    </span>
                </a>
            </li> --}}
            <li class="nav-item @if(isset($active) && $active == 'orders') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.orders')}}">
                    <i data-feather='list'></i>
                    <span class="menu-title text-truncate" data-i18n="طلبات الشراء">
                        طلبات الشراء
                    </span>
                </a>
            </li>

            <li class="nav-item @if(isset($active) && $active == 'contactMessages') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.contactmessages')}}">
                    <i data-feather='mail'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.contactMessages')}}">
                        {{trans('common.contactMessages')}}
                    </span>
                </a>
            </li>
            <?php /*
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather='layers'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.reports')}}">
                        {{trans('common.reports')}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li @if(isset($active) && $active == 'userFollowUpsReport') class="active" @endif>
                        <a class="d-flex align-items-center" href="{{route('admin.userFollowUpsReport')}}">
                            <i data-feather='circle'></i>
                            <span class="menu-item text-truncate" data-i18n="{{trans('common.userFollowUpsReport')}}">
                                {{trans('common.userFollowUpsReport')}}
                            </span>
                        </a>
                    </li>
                    @if(userCan('reports_accounts_view'))
                        <li @if(isset($active) && $active == 'accountsReport') class="active" @endif>
                            <a class="d-flex align-items-center" href="{{route('admin.accountsReport')}}">
                                <i data-feather='circle'></i>
                                <span class="menu-item text-truncate" data-i18n="{{trans('common.accountsReport')}}">
                                    {{trans('common.accountsReport')}}
                                </span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            */ ?>
            <li class=" navigation-header">
                <span data-i18n="روابط مساعدة">روابط مساعدة</span>
            </li>
            <li class="nav-item @if(isset($active) && $active == 'contracts') active @endif">
                <a class="d-flex align-items-center" href="{{route('website.index')}}">
                    <span class="menu-title text-truncate" data-i18n="معاينة الموقع الإلكتروني">
                        معاينة الموقع الإلكتروني
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
