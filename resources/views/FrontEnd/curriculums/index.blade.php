@extends('FrontEnd.layouts.master')
@section('content')


<?php
    $country_id = '';
    $university_id = '';
    $college_id = '';
    if (isset($_GET['country_id'])) {
        $country_id = $_GET['country_id'];
    }
    if (isset($_GET['university_id'])) {
        $university_id = $_GET['university_id'];
    }
    if (isset($_GET['college_id'])) {
        $college_id = $_GET['college_id'];
    }
?>


<!-- Inner Banner -->
<div class="inner-banner inner-banner-bg12">
    <div class="container">
        <div class="inner-title text-center">
            <h3>{{trans('common.whatDoYouKnowAboutOurCourses')}}</h3>
            <ul>
                <li>
                    <a href="{{url('/')}}">{{trans('common.PanelHome')}}</a>
                </li>
                <li>{{trans('learning.curriculums')}}</li>
            </ul>
        </div>
    </div>
</div>
<!-- Inner Banner End -->
@include('FrontEnd.layouts.curriculuims_search')
<!-- Courses Area -->
<div class="courses-area pb-70">
    <div class="container">
        <div class="row">
            @foreach ($curriculums as $course)
                <div class="col-lg-4 col-md-6">
                    <div class="courses-item" style="position: relative">
                        @if ($course->price == 0)
                            <span class="card-badge btn btn-sm btn-warning">
                                {{trans('common.free')}}
                            </span>
                        @endif
                        <a href="{{route('website.curriculums.details',$course->id)}}" class="text-center">
                            <img src="{{$course->photoLink()}}" alt="{{$course->name}}" />
                        </a>
                        <div class="content">
                            @if ($course->college != '')
                                <a href="{{route('website.curriculums',['country_id'=>$course->country_id,'university_id'=>$course->university_id,'college_id'=>$course->college_id])}}" class="tag-btn">
                                    {{$course->college != '' ? $course->college['name_'.session()->get('Lang')] : ''}}
                                </a>
                            @endif
                            @if ($course->price > 0)
                                <div class="price-text">
                                    {{$course->price}}
                                    {{trans('common.SR')}}
                                </div>
                            @else
                                <div class="price-text mt-2">
                                    {{trans('common.free')}}
                                </div>
                            @endif
                            <h3>
                                <a href="{{route('website.curriculums.details',$course->id)}}">
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
                                @foreach ($course->instructor_ids() as $instructor_id)
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
                                {{-- <div class="rating">
                                    <i class="ri-star-fill"></i>4k+ rating
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if (count($curriculums) > 0)
                <div class="col-lg-12 col-md-12 text-center">
                    <div class="pagination-area">
                        {{$curriculums->withQueryString()->links()}}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Courses Area End -->


@stop
