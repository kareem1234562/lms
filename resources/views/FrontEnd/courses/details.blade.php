@extends('FrontEnd.layouts.master')
@section('content')




        <!-- Inner Banner -->
        <div class="inner-banner inner-banner-bg12">
            <div class="container">
                <div class="inner-title">
                    <h3>{{$details['name']}}</h3>
                    {{-- <div class="rating">
                        <i class="ri-star-fill"></i>4k+ rating
                    </div> --}}
                    <div class="inner-banner-content">
                        @foreach ($details->instructor_ids() as $instructor_id)
                            @php
                                $instructor = App\Models\User::find($instructor_id);
                            @endphp
                            @if ($instructor != '')
                                <a href="{{route('website.trainers.details',$instructor_id)}}" class="user-area">
                                    @if ($instructor->photoLink() != '')
                                        <img src="{{$instructor->photoLink()}}" width="60" height="60" alt="{{$instructor['name_'.session()->get('Lang')]}}" />
                                    @endif
                                <h3>{{$instructor['name_'.session()->get('Lang')]}}</h3>
                                </a>
                            @endif
                        @endforeach
                        <ul class="course-list">
                            @if ($details->duration_hours != '')
                                <li><i class="ri-time-fill"></i> {{$details->duration_hours}} ساعة</li>
                            @endif
                            @if ($details->duration_lectures != '')
                                <li><i class="ri-vidicon-fill"></i> {{$details->duration_lectures}} محاضرة</li>
                            @endif
                        </ul>
                    </div>
                    <ul>
                        <li>
                            <a href="{{url('/')}}">الرئيسية</a>
                        </li>
                        <li>
                            <a href="{{route('website.courses')}}">الدورات التدريبية</a>
                        </li>
                        <li>{{$details['name']}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Courses Details Area -->
        <div class="courses-details-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="courses-details-contact">
                            <div class="tab courses-details-tab">
                                <ul class="tabs">
                                    <li>
                                        {{trans('common.details')}}
                                    </li>

                                    <li>
                                        {{trans('learning.lessons')}}
                                    </li>

                                    <li>
                                        {{trans('learning.instructor')}}
                                    </li>
                                </ul>
                                <div class="tab_content current active">
                                    <div class="tabs_item current">
                                        <div class="courses-details-tab-content">
                                            <div class="courses-details-into">
                                                {!!$details['details_'.session()->get('Lang')]!!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tabs_item">
                                        <div class="courses-details-tab-content">

                                            @if (count($lessons) > 0)

                                                <div class="courses-details-accordion">
                                                    <ul class="accordion">
                                                        <li class="accordion-item active">
                                                            <a class="accordion-title" href="javascript:void(0)">
                                                                <i class="ri-add-fill"></i>
                                                                {{trans('learning.lessons')}}
                                                            </a>
                                                            <div class="accordion-content show">
                                                                @foreach($lessons as $lesson)
                                                                    <div class="accordion-content-list">
                                                                        <div class="accordion-content-left">
                                                                            <i class="ri-bookmark-3-fill"></i>
                                                                            {{$lesson['name_ar']}}
                                                                        </div>
                                                                        <div class="accordion-content-right">
                                                                            {!! $lesson->checkUserCanWatch()!!}
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif

                                            <div class="courses-details-accordion">
                                                <ul class="accordion">
                                                    @forelse($sections as $section_key => $section_value)
                                                        <li class="accordion-item">
                                                            <a class="accordion-title" href="javascript:void(0)">
                                                                <i class="ri-add-fill"></i>
                                                                {{$section_value['name_ar']}}
                                                            </a>
                                                            <div class="accordion-content">
                                                                @foreach($section_value->lessons as $lesson)
                                                                    <div class="accordion-content-list">
                                                                        <div class="accordion-content-left">
                                                                            <i class="ri-bookmark-3-fill"></i>
                                                                            {{$lesson['name_ar']}}
                                                                        </div>
                                                                        <div class="accordion-content-right">
                                                                            {!! $lesson->checkUserCanWatch()!!}
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </li>
                                                    @empty

                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tabs_item">
                                        <div class="courses-details-tab-content">
                                            <div class="courses-details-instructor">
                                                <h3>عن المدرب</h3>

                                                @foreach ($details->instructor_ids() as $instructor_id)
                                                    @php
                                                        $instructor = App\Models\User::find($instructor_id);
                                                    @endphp
                                                    @if ($instructor != '')

                                                        <div class="details-instructor">
                                                            <img src="{{$instructor->photoLink()}}" alt="{{$instructor['name_'.session()->get('Lang')]}}" width="70" height="70" />
                                                            <h3>{{$instructor['name_'.session()->get('Lang')]}}</h3>
                                                            <span>{{$instructor['job_'.session()->get('Lang')]}}</span>
                                                        </div>
                                                        <ul class="course-list">
                                                            {{-- <li> <i class="ri-star-fill"></i>5 (30+ rating)</li> --}}
                                                            <li><i class="ri-vidicon-fill"></i> {{$details->duration_lectures}}</li>
                                                            <li><i class="ri-time-fill"></i> {{$details->duration_hours}}</li>
                                                        </ul>
                                                        {!!$instructor['bio_'.session()->get('Lang')]!!}
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="courses-details-sidebar text-center">
                            <img src="{{$details->photoLink()}}" alt="Courses" />
                            <div class="content text-right">
                                <h3>
                                    {{$details->price}}
                                    {{trans('common.SR')}}
                                </h3>
                                @if (auth()->check())
                                    @include('user.dashboard.includes.buy_btn')
                                @else
                                    <button type="button" class="default-btn" data-bs-toggle="modal" data-bs-target="#loginModal">
                                        {{trans('common.loginToPurchase')}}
                                    </button>
                                @endif
                                @if ($details->coins > 0)
                                    <ul class="social-link">
                                        <li class="social-title">{{trans('common.CoinsGaind')}}</li>
                                        {{$details->coins}}
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Courses Details Area End -->
        <div id="modalsContainer"></div>


        @if (!auth()->check())
            <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="loginModalLabel">{{trans('common.loginToPurchase')}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="auth-login-form mt-2" action="{{ route('website.login.submit') }}" method="POST">
                            <div class="modal-body">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <div class="form-group">
                                            <label for="email" class="mb-1">{{trans('common.email')}}</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{trans('common.email')}}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password" class="mb-1">{{trans('common.password')}}</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12 form-condition">
                                        <div class="agree-label">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label for="remember">
                                                {{trans('common.Remember Me')}}
                                                <a class="forget" href="{{route('password.request')}}">
                                                    {{trans('common.Forgot Password?')}}
                                                </a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <a class="forget" href="{{route('website.signup')}}">
                                            {{trans('common.Sign up')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="default-btn two" data-bs-dismiss="modal">{{trans('common.Cancel')}}</button>
                                <button type="submit" class="default-btn">{{trans('common.Sign in')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
@stop
