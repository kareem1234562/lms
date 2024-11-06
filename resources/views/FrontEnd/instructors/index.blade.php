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
                <li>المدربين</li>
            </ul>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- Instructors Area -->
<div class="instructors-area instructors-area-rs pt-100 pb-70">
    <div class="container">
        <div class="section-title text-center mb-45">
            <h2>أفضل الخبرات من أجلك</h2>
        </div>

        <div class="row justify-content-center">
            @foreach ($instructors as $instructor)
                <div class="col-lg-3 col-md-6">
                    <div class="instructors-card">
                        <a href="{{route('website.trainers.details',$instructor->id)}}">
                            <img src="{{$instructor->photoLink()}}" alt="{{$instructor['name']}}">
                        </a>
                        <div class="content">
                            @if ($instructor->facebook != '' || $instructor->instagram != '' || $instructor->twitter != '' || $instructor->linkedin != '')
                                <ul class="instructors-social">
                                    <li class="share-btn"><i class="ri-add-line"></i></li>
                                    @if ($instructor->facebook != '')
                                        <li>
                                            <a href="{{$instructor->facebook}}" target="_blank">
                                                <i class="ri-facebook-fill"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($instructor->instagram != '')
                                        <li>
                                            <a href="{{$instructor->instagram}}" target="_blank">
                                                <i class="ri-instagram-line"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($instructor->twitter != '')
                                        <li>
                                            <a href="{{$instructor->twitter}}" target="_blank">
                                                <i class="ri-twitter-fill"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($instructor->linkedin != '')
                                        <li>
                                            <a href="{{$instructor->linkedin}}" target="_blank">
                                                <i class="ri-linkedin-box-line"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                            <h3><a href="{{route('website.trainers.details',$instructor->id)}}">{{$instructor['name']}}</a></h3>
                            <span>{{$instructor['job_'.session()->get('Lang')]}}</span>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-lg-12 col-md-12 text-center">
                <div class="pagination-area">
                    {{$instructors->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Instructors Area End -->


@stop
