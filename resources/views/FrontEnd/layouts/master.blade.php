<!doctype html>
<html lang="{{trans('common.thisLang')}}" dir="{{trans('common.dir')}}">
    <head>
        <!-- Required Meta Tags -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{asset('FrontendAssets/assets/css/plugins.css')}}">
        <!-- Icon Plugins CSS -->
        <link rel="stylesheet" href="{{asset('FrontendAssets/assets/css/iconplugins.css')}}">
        <!-- Style CSS -->
        <link rel="stylesheet" href="{{asset('FrontendAssets/assets/css/style.css')}}">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{asset('FrontendAssets/assets/css/responsive.css')}}">
        <!-- Theme Dark CSS -->
        <link rel="stylesheet" href="{{asset('FrontendAssets/assets/css/theme-dark.css')}}">
        @if (session()->get('Lang') == 'ar')
            <!-- RTL CSS -->
            <link rel="stylesheet" href="{{asset('FrontendAssets/assets/css/rtl.css')}}">
        @endif

        <!-- Title -->
        <title>{{getSettingValue('website_title')}}</title>
        <meta name="description" content="{{isset($seo_description) ? $seo_description : getSettingValue('website_title')}}">
        <meta name="keywords" content="{{isset($seo_keywords) ? $seo_keywords : getSettingValue('website_keywords')}}">

        <!-- Favicon -->
        <link rel="icon" type="image/png')}}" href="{{asset('FrontendAssets/assets/images/favicon.png')}}">
        @yield('new_style')
        {!!getSettingValue('website_header_codes')!!}
    </head>
    <body>
        {{-- <!-- Pre Loader -->
        <div id="preloader">
            <div id="preloader-area">
                <div class="spinner"></div>
                <div class="spinner"></div>
                <div class="spinner"></div>
                <div class="spinner"></div>
                <div class="spinner"></div>
                <div class="spinner"></div>
                <div class="spinner"></div>
                <div class="spinner"></div>
            </div>
            <div class="preloader-section preloader-left"></div>
            <div class="preloader-section preloader-right"></div>
        </div>
        <!-- End Pre Loader --> --}}


        @include('FrontEnd.layouts.mainmenu')

        @yield('content')

        {{-- <!-- Newsletter Area -->
        <div class="newsletter-area section-bg ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="section-title mt-rs-20">
                            <span>ARE YOU IMPRESSED FOR AMAZING SERVICES?</span>
                            <h2>Subscribe our newsletter</h2>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <form class="newsletter-form" data-toggle="validator" method="POST">
                            <input type="email" class="form-control" placeholder="Enter Your Email Address" name="EMAIL" required autocomplete="off">
                            <button class="subscribe-btn" type="submit">
                                Subscribe Now  <i class="flaticon-paper-plane"></i>
                            </button>
                            <div id="validator-newsletter" class="form-result"></div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- Newsletter Area End --> --}}


        @include('FrontEnd.layouts.footer')

        <!-- Jquery Min JS -->
        <script src="{{asset('FrontendAssets/assets/js/jquery.min.js')}}"></script>
        <!-- Plugins JS -->
        {{-- <script src="{{asset('FrontendAssets/assets/js/plugins.js')}}"></script> --}}
        @include('FrontEnd.layouts.js-components')
        <!-- Custom  JS -->
        <script src="{{asset('FrontendAssets/assets/js/custom.js')}}"></script>
        @yield('scripts')

        {!!getSettingValue('website_footer_codes')!!}
        <style>
            .courses-item .card-badge {
                position:absolute;
                top:-10px;
                {{trans('common.absolute_position')}}:-8px;
                padding:5px;
                transform:rotate({{trans('common.absolute_position_degree')}}deg);
            }
        </style>

        @if (auth()->check())
            @if (isset($active))
                @if ($active == 'course')
                    <div class="modal fade" id="buyNowModal" tabindex="-1" aria-labelledby="buyNowModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="buyNowModalLabel">{{trans('common.loginToPurchase')}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                @if (auth()->user()->walletNet() >= $details->price)
                                    <div class="modal-body text-center">
                                        <b>
                                            لتأكيد خصم السعر المطلوب يرجى الضغط على الزر التالي
                                        </b>
                                        <a href="{{route('user.order.create',['course_id'=>$details->id])}}" class="default-btn">
                                            تأكيد الشراء
                                        </a>
                                    </div>
                                @else
                                    <div class="modal-body text-center">
                                        <b>
                                            {{trans('user.sorry! your wallet dosn\'t have enough money')}}
                                        </b>
                                        <p>{{trans('user.wallet')}}: {{auth()->user()->walletNet()}}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endif
    </body>
</html>
