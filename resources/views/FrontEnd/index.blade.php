@extends('FrontEnd.layouts.master')
@section('content')

        <!-- Hero Slider Area -->
        <div class="hero-slider-area">
            <div class="hero-slider owl-carousel owl-theme">
                @for($i=1;$i<=5;$i++)
                    @if (getSettingImageLink('home_slide'.$i.'img') != '')
                        <div class="hero-item">
                            <div class="container-fluid">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="hero-content">
                                            {{-- <span class="top-title">CHOOSE YOUR BEST COURSE</span> --}}
                                            <h1>{{getSettingValue('home_slide'.$i.'title_'.session()->get('Lang'))}}</h1>
                                            <p>
                                                {{getSettingValue('home_slide'.$i.'des_'.session()->get('Lang'))}}
                                            </p>
                                            <div class="banner-btn">
                                                <a href="{{route('website.curriculums')}}" class="default-btn border-radius-50">
                                                    {{trans('learning.freeCurriculums')}}
                                                </a>
                                                <a href="{{route('website.courses')}}" class="default-btn border-radius-50">
                                                    {{trans('learning.FreeCourses')}}
                                                </a>


<!-- this delete -->

                                            </div>

                                            <div class="footer-widget mt-2">
                                                <ul class="social-link">
                                                    <li class="social-title text-dark">{{trans('common.followUsBy')}}</li>
                                                    @if (getSettingValue('facebook') != '')
                                                        <li>
                                                            <a href="{{getSettingValue('facebook')}}" target="_blank">
                                                                <i class="ri-facebook-fill"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (getSettingValue('twitter') != '')
                                                        <li>
                                                            <a href="{{getSettingValue('twitter')}}" target="_blank">
                                                                <i class="ri-twitter-fill"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (getSettingValue('instagram') != '')
                                                        <li>
                                                            <a href="{{getSettingValue('instagram')}}" target="_blank">
                                                                <i class="ri-instagram-line"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (getSettingValue('linkedin') != '')
                                                        <li>
                                                            <a href="{{getSettingValue('linkedin')}}" target="_blank">
                                                                <i class="ri-linkedin-line"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="hero-img">
                                            <img src="{{getSettingImageLink('home_slide'.$i.'img')}}" class="hero" alt="Hero" />
                                            <div class="hero-bg-shape">
                                                <img src="{{asset('FrontendAssets/assets/images/home-three/bg-shape1.png')}}" class="bg-img-shape1" alt="Hero" />
                                                <img src="{{asset('FrontendAssets/assets/images/home-three/bg-shape2.png')}}" class="bg-img-shape2" alt="Hero" />
                                            </div>
                                            <div class="top-content">
                                                <div class="hero-img-content">
                                                    <i class="flaticon-student"></i>
                                                    <div class="content">
                                                        <h3>250K</h3>
                                                        <p>طالب مميز</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="right-content">
                                                <div class="hero-img-content">
                                                    <i class="flaticon-checked"></i>
                                                    <div class="content">
                                                        <h3>أنت مميز</h3>
                                                        <p>نعم أنت مميز لدينا</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
            <div class="hero-shape">
                <div class="shape1">
                    <img src="{{asset('FrontendAssets/assets/images/home-three/shape.png')}}" alt="Shape" />
                </div>
                <div class="shape2">
                    <img src="{{asset('FrontendAssets/assets/images/home-three/shape2.png')}}" alt="Shape" />
                </div>
            </div>
        </div>
        <!-- Hero Slider Area End -->

  

@stop

@section('scripts')
    <style>
        .courses-item .content .course-instructors {
            width: 70px;
            height: 70px;
        }
        .courses-item .content .course-instructors img {
            height: 100%;
            width: 100%;
        }
        .footer-area {
            display: none;
        }
        .hero-slider-area {
            min-height: 88vh;
        }
    </style>
@endsection
