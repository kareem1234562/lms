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






            <?php /*
            */ ?>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
