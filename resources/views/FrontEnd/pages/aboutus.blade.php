@extends('FrontEnd.layouts.master')
@section('content')

        <!-- Inner Banner -->
        <div class="inner-banner inner-banner-bg12">
            <div class="container">
                <div class="inner-title text-center">
                    <h3>{{trans('learning.aboutUs')}}</h3>
                    <ul>
                        <li>
                            <a href="{{url('/')}}">{{trans('common.PanelHome')}}</a>
                        </li>
                        <li>{{trans('learning.aboutUs')}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Enrolled Area -->
        <div class="enrolled-area-two pt-100 pb-70">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="enrolled-img-three mb-30 pr-20">
                            <img src="{{getSettingImageLink('aboutus_home_photo')}}" alt="من نحن">
                            {{-- <div class="enrolled-img-content">
                                <i class="flaticon-discount"></i>
                                <div class="content">
                                    <h3>Get 40% off</h3>
                                    <p>Every course</p>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="enrolled-content mb-30">
                            <div class="section-title">
                                <span>تعرف علينا</span>
                                @if (getSettingValue('aboutus_home_title') != '')
                                    <h2>{{getSettingValue('aboutus_home_title')}}</h2>
                                @endif
                                @if (getSettingValue('aboutus_home_des') != '')
                                    <p>{{getSettingValue('aboutus_home_des')}}</p>
                                @endif
                            </div>
                            <div class="row">
                                @if (getSettingValue('aboutus_home_list_1') != '' || getSettingValue('aboutus_home_list_3') != '')
                                    <div class="col-lg-6 col-6">
                                        <ul class="enrolled-list">
                                            @if (getSettingValue('aboutus_home_list_1'))
                                                <li><i class="flaticon-check"></i> {{getSettingValue('aboutus_home_list_1')}}</li>
                                            @endif
                                            @if (getSettingValue('aboutus_home_list_3'))
                                                <li><i class="flaticon-check"></i> {{getSettingValue('aboutus_home_list_3')}}</li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif

                                @if (getSettingValue('aboutus_home_list_2') != '' || getSettingValue('aboutus_home_list_4') != '')
                                    <div class="col-lg-6 col-6">
                                        <ul class="enrolled-list">
                                            @if (getSettingValue('aboutus_home_list_2'))
                                                <li><i class="flaticon-check"></i> {{getSettingValue('aboutus_home_list_2')}}</li>
                                            @endif
                                            @if (getSettingValue('aboutus_home_list_4'))
                                                <li><i class="flaticon-check"></i> {{getSettingValue('aboutus_home_list_4')}}</li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="banner-btn">
                                <a href="{{route('website.curriculums')}}" class="default-btn border-radius-50">
                                    {{trans('learning.freeCurriculums')}}
                                </a>
                                <a href="{{route('website.courses')}}" class="default-btn border-radius-50">
                                    {{trans('learning.FreeCourses')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Enrolled Area End -->

        <!-- Counter Area -->
        <div class="counter-area-three pb-70">
            <div class="container">
                <div class="counter-max">
                    <div class="row text-right" dir="ltr">
                        <div class="col-lg-3 col-6 col-md-3">
                            <div class="counter-content">
                                <i class="flaticon-online-course"></i>
                                <h3><span class="odometer" data-count="15">00000</span>+</h3>
                                <p>مجموعات تدريبية</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 col-md-3">
                            <div class="counter-content">
                                <i class="flaticon-student"></i>
                                <h3><span class="odometer" data-count="120">000000</span>+</h3>
                                <p>طلاب ناجحين</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 col-md-3">
                            <div class="counter-content">
                                <i class="flaticon-online-course-1"></i>
                                <h3><span class="odometer" data-count="12">00000</span>+</h3>
                                <p>مدربين</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 col-md-3">
                            <div class="counter-content">
                                <i class="flaticon-customer-satisfaction"></i>
                                <h3><span class="odometer" data-count="10000">000</span></h3>
                                <p>إعجابات المتفاعلين</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Counter Area End -->

        <!-- Testimonials Area -->
        <div class="testimonials-area pt-100 pb-100">
            <div class="container">
                <div class="section-title text-center">
                    <span>آراء طلابنا</span>
                    <h2>تعرف على ما يقوله طلابنا</h2>
                </div>
                <div class="testimonials-slider-two owl-carousel owl-theme">
                    <div class="testimonials-card-two">
                        <div class="rating">
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                        </div>
                        <p>“كنت فاكر ان الموضوع هيكون صعب وإني مش هقدر اتعلم الفوتوشوب كويس وفعلا الموضوع كان صعب في البداية لدرجة اني افتكرت اني مش هوصل لحاجة مش هقدر أوصف اللي قدرت أوصله في النهاية فعلا ناس مجتهدة وعارفه بتعمل ايه.”</p>
                        <div class="content">
                            <img src="{{asset('FrontendAssets/assets/images/testimonials/testimonials-img1.jpg')}}" alt="testimonials" />
                            <h3>محمد إبراهيم</h3>
                            <span>طالب</span>
                        </div>
                        <div class="quote"> <i class="flaticon-quote"></i></div>
                    </div>
                    <div class="testimonials-card-two">
                        <div class="rating">
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                        </div>
                        <p>“حاولت كتير أدور على دورات تدريبية فعليه لكن كل اللي بشوفه حاجات تعليميه للمبتدئين أول مره ألاقي مكان بيبدأ مع المبتدئين ويوصل للاحتراف بجد”</p>
                        <div class="content">
                            <img src="{{asset('FrontendAssets/assets/images/testimonials/testimonials-img1.jpg')}}" alt="testimonials" />
                            <h3>محمود</h3>
                            <span>موظف</span>
                        </div>
                        <div class="quote"> <i class="flaticon-quote"></i></div>
                    </div>
                    <div class="testimonials-card-two">
                        <div class="rating">
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                            <i class="ri-star-fill"></i>
                        </div>
                        <p>“كل تفكيري كان ازاي الاقي فرصة عمل في مجال البرمجة وروحت اكتر من مكان برا كفر الشيخ عشان ألاقي اللي بدور عليه لغاية ما لاقيت المكان هنا وماكنتش مصدق ان فيه مكان بالشكل ده والاهتمام ده في كفر الشيخ”</p>
                        <div class="content">
                            <img src="{{asset('FrontendAssets/assets/images/testimonials/testimonials-img1.jpg')}}" alt="testimonials" />
                            <h3>يوسف</h3>
                            <span>طالب</span>
                        </div>
                        <div class="quote"> <i class="flaticon-quote"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonials Area End -->

        <!-- Instructors Area -->
        {{-- <div class="instructors-area pb-70">
            <div class="container">
                <div class="section-title text-center mb-45">
                    <h2>Meet our top instructor</h2>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="instructors-card">
                            <a href="instructors-details.html">
                                <img src="assets/images/instructors/instructors-img1.jpg" alt="Team Images">
                            </a>
                            <div class="content">
                                <ul class="instructors-social">
                                    <li class="share-btn"><i class="ri-add-line"></i></li>
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <i class="ri-facebook-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/" target="_blank">
                                            <i class="ri-instagram-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/" target="_blank">
                                            <i class="ri-twitter-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/" target="_blank">
                                            <i class="ri-linkedin-box-line"></i>
                                        </a>
                                    </li>
                                </ul>
                                <h3><a href="instructors-details.html">Sally welch</a></h3>
                                <span>Web designer</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="instructors-card">
                            <a href="instructors-details.html">
                                <img src="assets/images/instructors/instructors-img2.jpg" alt="Team Images">
                            </a>
                            <div class="content">
                                <ul class="instructors-social">
                                    <li class="share-btn"><i class="ri-add-line"></i></li>
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <i class="ri-facebook-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/" target="_blank">
                                            <i class="ri-instagram-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/" target="_blank">
                                            <i class="ri-twitter-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/" target="_blank">
                                            <i class="ri-linkedin-box-line"></i>
                                        </a>
                                    </li>
                                </ul>
                                <h3><a href="instructors-details.html">Jesse joslin</a></h3>
                                <span>Content strategist</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="instructors-card">
                            <a href="instructors-details.html">
                                <img src="assets/images/instructors/instructors-img3.jpg" alt="Team Images">
                            </a>
                            <div class="content">
                                <ul class="instructors-social">
                                    <li class="share-btn"><i class="ri-add-line"></i></li>
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <i class="ri-facebook-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/" target="_blank">
                                            <i class="ri-instagram-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/" target="_blank">
                                            <i class="ri-twitter-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/" target="_blank">
                                            <i class="ri-linkedin-box-line"></i>
                                        </a>
                                    </li>
                                </ul>
                                <h3><a href="instructors-details.html">Lance altman</a></h3>
                                <span>Photographer</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="instructors-card">
                            <a href="instructors-details.html">
                                <img src="assets/images/instructors/instructors-img4.jpg" alt="Team Images">
                            </a>
                            <div class="content">
                                <ul class="instructors-social">
                                    <li class="share-btn"><i class="ri-add-line"></i></li>
                                    <li>
                                        <a href="https://www.facebook.com/" target="_blank">
                                            <i class="ri-facebook-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/" target="_blank">
                                            <i class="ri-instagram-line"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/" target="_blank">
                                            <i class="ri-twitter-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/" target="_blank">
                                            <i class="ri-linkedin-box-line"></i>
                                        </a>
                                    </li>
                                </ul>
                                <h3><a href="instructors-details.html">Jonquil von</a></h3>
                                <span>Art director</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Instructors Area End -->

@stop
