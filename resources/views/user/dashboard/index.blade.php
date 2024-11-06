@extends('FrontEnd.layouts.master')
@section('content')

<div class="container pt-4">
    <div class="main-body">
        <div class="row">
            @if (session()->get('faild') != '')
                <div class="col-12">
                    <div class="alert alert-danger mb-2 p-3">
                        {{session()->get('faild')}}
                    </div>
                </div>
            @endif
            @if(session()->get('success') != '')
                <div class="alert alert-success py-2 text-center">
                    {{session()->get('success')}}
                </div>
                {{session()->forget('success')}}
            @endif
            <div class="col-lg-4">
                @include('user.dashboard.includes.sidebar')
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-title m-0 p-3">
                                <h3 class="m-0 pb-3 border-bottom border-secondary text-primary">
                                    {{trans('common.Purhcases')}}
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row row-cols-1 row-cols-md-2 g-4">
                                    @foreach(auth()->user()->studentCourses as $course)
                                        @if ($course->is_course == '1')
                                            <?php $link = route('website.courses.details',$course->id); ?>
                                        @else
                                            <?php $link = route('website.curriculums.details',$course->id); ?>
                                        @endif
                                        <div class="col">
                                            {{$course->status}}
                                            <a href="{{ $course->pivot->status == 'pending' ? 'javascript:void(0)' : $link }}"
                                                @if ($course->pivot->status == 'pending')
                                                    class="disabled-link"
                                                    style="pointer-events: none; cursor: not-allowed;"
                                                @endif>
                                                <div class="card {{ $course->pivot->status == 'pending' ? 'disabled-card' : '' }}">
                                                    @if ($course->pivot->status == 'pending')
                                                        <span class="badge bg-warning position-absolute top-0 end-0 m-2">جاري مراجعة الدفع</span>
                                                    @endif
                                                    <img src="{{$course->photoLink()}}" class="card-img-top" alt="{{$course->name}}">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{$course->name}}</h5>
                                                        <p class="card-text">
                                                            {{Str::limit($course['details_'.session()->get('Lang')], 50)}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.me-2 {
    margin-right: .5rem!important;
}
</style>

@stop
