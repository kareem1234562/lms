@extends('FrontEnd.layouts.master')
@section('content')
    <div class="container">
        @if (count($courses) > 0)
            <div class="row">
                <div class="section-title text-center mb-2 mt-4">
                    <h2>{{trans('learning.courses')}}</h2>
                </div>
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6">
                        <div class="courses-item" style="position: relative">
                            @if ($course->price == 0)
                                <span class="card-badge btn btn-sm btn-warning">
                                    {{trans('common.free')}}
                                </span>
                            @endif
                            <a href="{{route('website.courses.details',$course->id)}}" class="text-center">
                                <img src="{{$course->photoLink()}}" alt="{{$course->name}}" />
                            </a>
                            <div class="content">
                                @if ($course->college != '')
                                    <a href="{{route('website.courses',['country_id'=>$course->country_id,'university_id'=>$course->university_id,'college_id'=>$course->college_id])}}" class="tag-btn">
                                        {{$course->college != '' ? $course->college['name_'.session()->get('Lang')] : ''}}
                                    </a>
                                @endif
                                @if ($course->price > 0)
                                    <div class="price-text">
                                        {{$course->price}}
                                        {{trans('common.SR')}}
                                    </div>
                                @endif
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
            </div>
        @endif
        @if (count($curriculums) > 0)
            <div class="row">
                <div class="section-title text-center mb-2 mt-4">
                    <h2>{{trans('learning.curriculums')}}</h2>
                </div>
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
            </div>
        @endif
        @if (count($sections) > 0)
            <div class="row">
                <div class="section-title text-center mb-2 mt-4">
                    <h2>{{trans('learning.Categories')}}</h2>
                </div>
                <ul>
                    @foreach ($sections as $section)
                        <li>
                            <a href="{{route('website.courses',['section_id'=>$section->id])}}">
                                {{$section['name_'.session()->get('Lang')]}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (count($Univerisities) > 0)
            <div class="row">
                <div class="section-title text-center mb-2 mt-4">
                    <h2>{{trans('learning.univerisities')}}</h2>
                </div>
                <ul>
                    @foreach ($Univerisities as $uni)
                        <li>
                            <a href="{{route('website.curriculums',['country_id'=>$uni->country_id,'university_id'=>$uni->id,'college_id'=>''])}}">
                                {{$uni['name_'.session()->get('Lang')]}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (count($Colleges) > 0)
            <div class="row">
                <div class="section-title text-center mb-2 mt-4">
                    <h2>{{trans('learning.colleges')}}</h2>
                </div>
                <ul>
                    @foreach ($Colleges as $College)
                        <li>
                            <a href="{{route('website.curriculums',['country_id'=>$College->country_id,'university_id'=>$College->university_id,'college_id'=>$College->id])}}">
                                {{$College['name_'.session()->get('Lang')]}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (count($courses) == 0 && count($curriculums) == 0 && count($sections) == 0 && count($Univerisities) == 0 && count($Colleges) == 0)
            <div class="col-12 p-4">
                <div class="alert alert-danger alert-lg">
                    {{trans('common.nothingToView')}}
                </div>
            </div>
        @endif
    </div>
@stop

