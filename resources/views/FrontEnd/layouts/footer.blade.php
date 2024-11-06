<!-- Footer Area -->
<footer class="footer-area">
    <div class="container pt-100 pb-70">
         <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget">
                    <div class="footer-logo text-center">
                        <a href="{{url('/')}}">
                            <img src="{{getSettingImageLink('logo')}}" alt="Images" height="150">
                        </a>
                    </div>
                    <p>
                        {{getSettingValue('footer_word_'.session()->get('Lang'))}}
                    </p>
                    <ul class="social-link">
                        <li class="social-title">{{trans('common.followUsBy')}}</li>
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
            <div class="col-lg-3 col-sm-6">
                <div class="footer-widget ps-5">
                    <h3>{{trans('common.pages')}}</h3>
                    <ul class="footer-list">
                        <li>
                            <a href="{{route('website.aboutus')}}">
                                {{trans('learning.aboutUs')}}
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{route('website.faqs')}}">
                                {{trans('learning.faqs')}}
                            </a>
                        </li>  --}}
                        <li>
                            <a href="{{route('website.trainers')}}">
                                {{trans('learning.trainers')}}
                            </a>
                        </li>
                        <li>
                            <a href="{{route('website.courses')}}">
                                {{trans('learning.courses')}}
                            </a>
                        </li>
                        <li>
                            <a href="{{route('website.curriculums')}}">
                                {{trans('learning.curriculums')}}
                            </a>
                        </li>
                        <li>
                            <a href="{{route('website.contactus')}}">
                                {{trans('common.contactUs')}}
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{route('website.events')}}">
                                {{trans('learning.events')}}
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>
            {{-- <div class="col-lg-3 col-sm-6">
                <div class="footer-widget ps-5">
                    <h3>مصادر تهمك</h3>
                    <ul class="footer-list">
                        <li>
                            <a href="{{url('/')}}">
                                الرئيسية
                            </a>
                        </li>
                        <li>
                            <a href="{{route('website.courses')}}">
                                {{trans('learning.courses')}}
                            </a>
                        </li>
                        <li>
                            <a href="{{route('website.blog')}}">
                                {{trans('learning.blog')}}
                            </a>
                        </li>
                        <li>
                            <a href="{{route('website.contactus')}}">
                                {{trans('common.contactUs')}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div> --}}
            <div class="col-lg-6 col-sm-6">
                <div class="footer-widget ps-5">
                    <h3>{{trans('common.contacts')}}</h3>
                    <ul class="footer-contact">
                        <li>
                            <i class="ri-map-pin-2-fill"></i>
                            <div class="content">
                                <h4>{{trans('common.address')}}</h4>
                                <span>{{getSettingValue('address')}}</span>
                            </div>
                        </li>
                        <li>
                            <i class="ri-mail-fill"></i>
                            <div class="content">
                                <h4>{{trans('common.email')}}</h4>
                                <span><a href="mailto:{{getSettingValue('email')}}">{{getSettingValue('email')}}</a></span>
                            </div>
                        </li>
                        <li>
                            <i class="ri-phone-fill"></i>
                            <div class="content">
                                <h4>{{trans('common.phone')}}</h4>
                                <span><a href="tel:{{getSettingValue('mobile')}}">{{getSettingValue('mobile')}}</a></span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="copyright-area">
        <div class="container">
            <div class="copy-right-text text-center">
                <p>
                    حقوق إمتلاك المحتوى الإلكتروني @<script>document.write(new Date().getFullYear())</script> <b>كورسيز زون</b> كافة الحقوق محفوظه
                    <br>تم التنفيذ بالمشاركة مع <a href="https://technomasr.com/" target="_blank">تكنو مصر للبرمجيات</a>
                </p>
            </div>
        </div>
    </div> --}}
</footer>
<!-- Footer Area End -->
