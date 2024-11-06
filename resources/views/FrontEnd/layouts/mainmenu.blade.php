<!-- Start Navbar Area -->
<div class="navbar-area">
    <div class="mobile-responsive-nav">
        <div class="container">
           <div class="mobile-responsive-menu">
                <div class="logo">
                    <a href="{{route('website.index')}}">
                        <img src="{{getSettingImageLink('logo')}}" class="logo-one" alt="logo" width="100%">
                        <img src="{{getSettingImageLink('logo')}}" class="logo-two" alt="logo" width="100%">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="desktop-nav nav-area">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-light ">
                <a class="navbar-brand" href="{{route('website.index')}}">
                    <img src="{{getSettingImageLink('logo')}}" class="logo-one" alt="Logo" height="45">
                    <img src="{{getSettingImageLink('logo')}}" class="logo-two" alt="Logo" height="45">
                </a>

                <div class="nav-widget-form">
                    {!! Form::open(['class'=>'search-form search-form-bg','method'=>'GET','url'=>route('website.students.search')]) !!}
                        <input type="search" name="s" class="form-control" placeholder="{{trans('common.search')}}">
                        <button type="submit">
                            <i class="ri-search-line"></i>
                        </button>
                    {!! Form::close() !!}
                </div>

                {{-- <div class="navbar-category">
                    <div class="dropdown category-list-dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButtoncategory" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class='flaticon-list'></i>
                            {{trans('learning.Categories')}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButtoncategory">
                            <?php
                                $menu_sections = App\Models\CoursesSections::get();
                            ?>
                            @foreach ($menu_sections as $key => $section)
                                <a href="{{route('website.courses',['cate'=>$section->id])}}" class="nav-link-item">
                                    <i class="{{$section->icon}}"></i>
                                    {{$section['name_'.session()->get('Lang')]}}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div> --}}

                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{route('website.index')}}" class="nav-link">
                                {{trans('learning.home')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('website.aboutus')}}" class="nav-link">
                                {{trans('learning.aboutUs')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('website.courses')}}" class="nav-link">
                                {{trans('learning.courses')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('website.curriculums')}}" class="nav-link">
                                {{trans('learning.curriculums')}}
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{route('website.faqs')}}" class="nav-link">
                                {{trans('learning.faqs')}}
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="{{route('website.trainers')}}" class="nav-link">
                                {{trans('learning.trainers')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('website.events')}}" class="nav-link">
                                {{trans('learning.events')}}
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="{{route('website.blog')}}" class="nav-link">
                                {{trans('learning.blog')}}
                            </a>
                        </li> --}}

                        {{-- <li class="nav-item">
                           <a href="#" class="nav-link dropdown-toggle">
                                Pages
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="about.html" class="nav-link">
                                        About Us
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="testimonials.html" class="nav-link">
                                        Testimonials
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="faq.html" class="nav-link">
                                        FAQ
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="cart.html" class="nav-link">
                                        Cart
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="checkout.html" class="nav-link">
                                        Checkout
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">
                                        Instructors
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="instructors.html" class="nav-link">
                                                Instructors
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="instructors-details.html" class="nav-link">
                                                Instructors Details
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="pricing.html" class="nav-link">
                                        Pricing Plan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">
                                        User
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="signin.html" class="nav-link">
                                                Sign in
                                            </a>
                                        </li>
                                       <li class="nav-item">
                                            <a href="signup.html" class="nav-link">
                                                Sign Up
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="forgot-password.html" class="nav-link">
                                                Forgot Password
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="terms-condition.html" class="nav-link">
                                        Terms & Conditions
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="privacy-policy.html" class="nav-link">
                                        Privacy Policy
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="404.html" class="nav-link">
                                        404 Page
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="coming-soon.html" class="nav-link">
                                        Coming Soon
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link dropdown-toggle">
                                Courses
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                <a href="courses.html" class="nav-link">
                                        Courses
                                </a>
                                </li>
                                <li class="nav-item">
                                    <a href="courses-list.html" class="nav-link">
                                        Courses List
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="courses-sidebar.html" class="nav-link">
                                        Courses Sidebar
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="courses-details.html" class="nav-link">
                                        Courses Details
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link dropdown-toggle">
                                Event
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="event.html" class="nav-link">Event</a>
                                </li>
                                <li class="nav-item">
                                    <a href="event-details.html" class="nav-link">Event Details</a>
                                </li>
                            </ul>
                        </li> --}}

                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link dropdown-toggle">
                                {{trans('common.Blog')}}
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="blog.html" class="nav-link">
                                        {{trans('common.Blog Grid')}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="single-blog-1.html" class="nav-link">
                                        {{trans('common.Single Blog')}}
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        <li class="nav-item">
                            <a href="{{route('website.contactus')}}" class="nav-link">
                                {{trans('common.contactUs')}}
                            </a>
                        </li>
                        @foreach(panelLangMenu()['list'] as $singleLang)
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/SwitchLang/'.$singleLang['lang'])}}">
                                    {{$singleLang['text']}}
                                </a>
                            </li>
                        @endforeach
                        @if (auth()->check())
                            <?php $cartCount = App\Models\OrderItems::where('status','cart')
                                                        ->where('user_id',auth()->user()->id)
                                                        ->count(); ?>

                            <a href="{{route('user.cart.show')}}">
                                <div class="btn btn-icon rounded-pill btn-warning mx-3 position-relative d-block d-sm-none d-md-block d-lg-none">
                                    <i class="ri-shopping-cart-fill"></i>
                                    <span id="cart-count2" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $cartCount }}
                                    </span>
                                </div>
                            </a>

                            <li class="nav-item d-block d-sm-none d-md-block d-lg-none">
                                <a href="{{route('user.dashboard.index')}}" class="nav-link">
                                    {{trans('user.dashboard')}}
                                </a>
                            </li>
                            <li class="nav-item d-block d-sm-none d-md-block d-lg-none">
                                <a href="{{ route('website.logout') }}" class="nav-link">
                                    {{trans('common.Logout')}}
                                </a>
                            </li>
                        @else
                            <li class="nav-item d-block d-sm-none d-md-block d-lg-none">
                                <a href="{{route('website.login')}}" class="nav-link">
                                    {{trans('common.Sign in')}}
                                </a>
                            </li>
                            <li class="nav-item d-block d-sm-none d-md-block d-lg-none">
                                <a href="{{route('website.signup')}}" class="nav-link">
                                    {{trans('common.Sign up')}}
                                </a>
                            </li>
                        @endif
                    </ul>


                    <div class="others-options d-flex align-items-center">
                        @if (auth()->check())
                            <div class="btn btn-icon rounded-pill btn-warning mx-3 position-relative">
                                <a href="{{route('user.cart.show')}}">
                                    <i class="ri-shopping-cart-fill"></i>
                                    <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $cartCount }}
                                    </span>
                                </a>
                            </div>
                            <div class="optional-item">
                                <a href="{{route('user.dashboard.index')}}" class="default-btn one border-radius-50">
                                    {{trans('user.dashboard')}}
                                </a>
                            </div>
                            <div class="optional-item mx-1">
                                <a href="{{ route('website.logout') }}" class="default-btn one border-radius-50">
                                    {{trans('common.Logout')}}
                                </a>
                            </div>
                        @else
                            <div class="optional-item">
                                <a href="{{route('website.login')}}" class="default-btn one border-radius-50">
                                    {{trans('common.Sign in')}}
                                </a>
                            </div>
                            <div class="optional-item mx-1">
                                <a href="{{route('website.signup')}}" class="default-btn one border-radius-50">
                                    {{trans('common.Sign up')}}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="side-nav-responsive">
        <div class="container">
            <div class="dot-menu">
                <div class="circle-inner">
                    <div class="circle circle-one"></div>
                    <div class="circle circle-two"></div>
                    <div class="circle circle-three"></div>
                </div>
            </div>

            <div class="container">
                <div class="side-nav-inner">
                    <div class="side-nav justify-content-center align-items-center">
                        <div class="side-item">
                            {!! Form::open(['class'=>'search-form','method'=>'GET','url'=>route('website.students.search')]) !!}
                                <input type="search" name="s" class="form-control" placeholder="{{trans('common.search')}}">
                                <button type="submit">
                                    <i class="ri-search-line"></i>
                                </button>
                            {!! Form::close() !!}
                        </div>

                        {{-- <div class="side-item">
                            <a href="signup.html" class="default-btn two">{{trans('learning.Sign Up')}}</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Navbar Area -->
