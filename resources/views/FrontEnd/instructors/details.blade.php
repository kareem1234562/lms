@extends('FrontEnd.layouts.master')
@section('content')



<!-- Inner Banner -->
<div class="inner-banner inner-banner-bg12">
    <div class="container">
        <div class="inner-title text-center">
            <h3>تعرف على فريق التدريب لدينا</h3>
            <ul>
                <li>
                    <a href="{{url('/')}}">الرئيسية</a>
                </li>
                <li>
                    <a href="{{route('website.trainers')}}">المدربين</a>
                </li>
                <li>{{$details['name']}}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- Instructors Details Area -->
<div class="instructors-details-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="instructors-details-img">
                    <img src="{{$details->photoLink()}}" alt="Instructor" />
                    @if ($details->facebook != '' || $details->instagram != '' || $details->twitter != '' || $details->linkedin != '')
                        <ul class="social-link">
                            <li class="share-btn"><i class="ri-add-line"></i></li>
                            @if ($details->facebook != '')
                                <li>
                                    <a href="{{$details->facebook}}" target="_blank">
                                        <i class="ri-facebook-fill"></i>
                                    </a>
                                </li>
                            @endif
                            @if ($details->instagram != '')
                                <li>
                                    <a href="{{$details->instagram}}" target="_blank">
                                        <i class="ri-instagram-line"></i>
                                    </a>
                                </li>
                            @endif
                            @if ($details->twitter != '')
                                <li>
                                    <a href="{{$details->twitter}}" target="_blank">
                                        <i class="ri-twitter-fill"></i>
                                    </a>
                                </li>
                            @endif
                            @if ($details->linkedin != '')
                                <li>
                                    <a href="{{$details->linkedin}}" target="_blank">
                                        <i class="ri-linkedin-box-line"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
            <div class="col-lg-9">
                <div class="instructors-details-content pl-20">
                    <h3>{{$details['name']}}</h3>
                    <span class="sub-title">{{$details['job_'.session()->get('Lang')]}}</span>
                    <ul>
                        {{-- <li>عدد الطلاب: <span>{{$details->studentsCount()}}</span></li> --}}
                        <li>الدورات التدريبية: <span>{{$details->courses()->count()}}</span></li>
                    </ul>
                    {!!$details['bio']!!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Instructors Details Area End -->

<!-- Courses Area -->
<div class="courses-area pb-70">
    <div class="container">
        <div class="section-title text-center mb-45">
            <h2>الدورات التدريبية</h2>
            <p>
                تعرف على كافة الدورات التدريبية التي يقوم بتقديمها المدرب داخل الشركة
            </p>
        </div>
        <div class="row">
            @foreach ($details->courses as $course)
                <div class="col-lg-4 col-md-6">
                    <div class="courses-item">
                        <a href="{{route('website.courses.details',$course->id)}}">
                            <img src="{{$course->photoLink()}}" alt="{{$course->name}}" />
                        </a>
                        <div class="content">
                            <a href="{{route('website.courses',['cate'=>$course->section_id])}}" class="tag-btn">
                                {{$course->section != '' ? $course->section['name'] : ''}}
                            </a>
                            <div class="price-text">
                                {{$course->price}}
                                {{trans('common.SR')}}
                            </div>
                            <h3>
                                <a href="{{route('website.courses.details',$course->id)}}">
                                    {{$course->name}}
                                </a>
                            </h3>
                            <ul class="course-list">
                                @if ($course->duration_hours != '')
                                    <li><i class="ri-time-fill"></i> {{$course->duration_hours}} ساعة</li>
                                @endif
                                @if ($course->duration_lectures != '')
                                    <li><i class="ri-vidicon-fill"></i> {{$course->duration_lectures}} محاضرة</li>
                                @endif
                            </ul>
                            <div class="bottom-content">
                                <a href="{{route('website.trainers.details',$course->instructor_id)}}" class="user-area">
                                    @if ($course->instructor != '')
                                        @if ($course->instructor->photoLink() != '')
                                            <img src="{{$course->instructor->photoLink()}}" width="60" height="60" alt="{{$course->instructor['name']}}" />
                                        @endif
                                    @endif
                                    <h3>{{$course->instructor['name']}}</h3>
                                </a>
                                {{-- <div class="rating">
                                    <i class="ri-star-fill"></i>4k+ rating
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Courses Area End -->


@stop
