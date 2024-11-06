@extends('FrontEnd.layouts.master')
@section('content')


        <!-- Inner Banner -->
        <div class="inner-banner inner-banner-bg12">
            <div class="container">
                <div class="inner-title text-center">
                    <h3>تفاصيل الفعاليه / ورشة العمل</h3>
                    <ul>
                        <li>
                            <a href="{{url('/')}}">الرئيسية</a>
                        </li>
                        <li>
                            <a href="{{route('website.events')}}">الفعاليات / ورش العمل</a>
                        </li>
                        <li>تفاصيل الفعاليه / ورشة العمل </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Event Details Area -->
        <div class="event-details-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="event-details-content pr-20">
                            <div class="event-preview-img text-center">
                                <img src="{{$details->photoLink()}}" alt="{{$details->title}}" height="400">
                            </div>
                            {!!$details->details!!}
                            {{-- <h3 class="event-details-mt-30">Our speakers</h3>
                            <div class="row justify-content-center event-details-mt-30">
                                <div class="col-lg-3 col-md-6">
                                    <div class="instructors-item instructors-item-bg">
                                        <div class="instructors-img">
                                            <a href="instructors-details.html">
                                                <img src="assets/images/instructors/instructors-img1.jpg" alt="Team Images">
                                            </a>
                                            <ul class="instructors-social">
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
                                        </div>
                                        <div class="content">
                                            <h3><a href="instructors-details.html">Sally welch</a></h3>
                                            <span>Web designer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="instructors-item instructors-item-bg">
                                        <div class="instructors-img">
                                            <a href="instructors-details.html">
                                                <img src="assets/images/instructors/instructors-img2.jpg" alt="Team Images">
                                            </a>
                                            <ul class="instructors-social">
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
                                        </div>
                                        <div class="content">
                                            <h3><a href="instructors-details.html">Jesse joslin</a></h3>
                                            <span>Content strategist</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="instructors-item instructors-item-bg">
                                        <div class="instructors-img">
                                            <a href="instructors-details.html">
                                                <img src="assets/images/instructors/instructors-img3.jpg" alt="Team Images">
                                            </a>
                                            <ul class="instructors-social">
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
                                        </div>
                                        <div class="content">
                                            <h3><a href="instructors-details.html">Lance altman</a></h3>
                                            <span>Photographer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="instructors-item instructors-item-bg">
                                        <div class="instructors-img">
                                            <a href="instructors-details.html">
                                                <img src="assets/images/instructors/instructors-img4.jpg" alt="Team Images">
                                            </a>
                                            <ul class="instructors-social">
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
                                        </div>
                                        <div class="content">
                                            <h3><a href="instructors-details.html">Jonquil von</a></h3>
                                            <span>Art director</span>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="event-sidebar">
                            <h3 class="title">التفاصيل</h3>
                            <ul>
                                <li>المكان: <span>{!!$details->place!!}</span></li>
                                <li>اليوم: <span>{!!$details->date!!}</span></li>
                                <li>الساعة: <span>{!!$details->time!!}</span></li>
                                <li>المنظم: <span>{!!$details->organizer!!}</span> </li>
                            </ul>
                            <a href="{{route('website.book',['type'=>'event','id'=>$details->id])}}" class="default-btn btn-block mt-2">احجز الآن</a>
                        </div>
                        <?php $events = App\Models\Events::where('id','!=',$details->id)->orderBy('id','desc')->take('4')->get(); ?>
                        @if (count($events) > 0)
                            <div class="event-popular-post">
                                @foreach ($events as $event)
                                    <article class="item">
                                        <a href="{{route('website.events.details',$event->id)}}" class="thumb">
                                            <span class="full-image cover bg1">
                                                <img src="{{$event->photoLink()}}" alt="{{$event->title}}" />
                                            </span>
                                        </a>
                                        <div class="info">
                                            <h3>
                                                <a href="{{route('website.events.details',$event->id)}}">
                                                    {{$event->title}}
                                                </a>
                                            </h3>
                                            <p>{{strip_tags(\Illuminate\Support\Str::words($event->details, 10))}}</p>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Event Details Area End -->

@stop
