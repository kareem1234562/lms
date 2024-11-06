@extends('FrontEnd.layouts.master')
@section('content')

        <!-- Inner Banner -->
        <div class="inner-banner inner-banner-bg12">
            <div class="container">
                <div class="inner-title text-center">
                    <h3>نتائج البحث</h3>
                    <ul>
                        <li>
                            <a href="{{url('/')}}">الرئيسية</a>
                        </li>
                        <li>نتيجة البحث عن: {{$_GET['s']}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->
        @if ($student != '')
            <div class="instructors-details-area pt-100 pb-70">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="instructors-details-img">
                                <img src="{{$student->photoLink()}}" alt="{{$student->Name}}" />
                                <ul class="social-link">
                                    <li class="share-btn"><i class="ri-add-line"></i></li>
                                    @if ($student->cellphone != '')
                                        <li>
                                            <a href="tel:{{$student->cellphone}}">
                                                <i class="ri-smartphone-line"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($student->whatsapp != '')
                                        <li>
                                            <a href="https://wa.me/{{$student->whatsapp}}" target="_blank">
                                                <i class="ri-whatsapp-line"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-12">
                                    <h4>{{trans('common.data')}}</h4>
                                    <hr>
                                    <div class="row mb-1">
                                        <div class="col-md-2">
                                            <b>{{trans('common.name')}}:</b>
                                        </div>
                                        <div class="col-md-10">
                                            {{$student->Name}}
                                        </div>
                                    </div>

                                    <div class="row mb-1">
                                        <div class="col-md-2">
                                            <b>{{trans('common.phone')}}:</b>
                                        </div>
                                        <div class="col-md-10">
                                            {{$student->cellphone}}
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- الدورات التدريبية --}}
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h4>{{trans('learning.courses')}}</h4>
                                    <hr>
                                    @forelse ($student->courses()->where('status','done')->get() as $reservation)
                                        <div class="col-md-6">
                                            @if ($reservation->certificate != '')
                                                <img src="{{$reservation->certificateLink()}}" alt="" width="100%">
                                            @endif
                                            <h4>{{$reservation->course->name}}</h4>
                                        </div>
                                    @empty
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                لم ينهي الطالب أياً من الدورات التدريبية الخاصة به
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            {{-- الأعمال السابقة --}}
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h4>{{trans('learning.portfolio')}}</h4>
                                    <hr>
                                    @forelse ($student->courses()->where('status','done')->get() as $course)
                                        <h1>
                                            {{$course->course->name}}
                                        </h1>
                                    @empty
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                لم ينهي الطالب أياً من الدورات التدريبية الخاصة به
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="instructors-details-area pt-100 pb-70">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger">
                                عذراً لا يوجد لدينا نتيجة للبحث الخاص بك
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <style>
            .row .col-md-2 b {
                background-color: #f1f1f1;
                width: 100%;
                display: block;
                border-radius: 0px 5px 5px 0px;
                padding: 3px 10px;
                color: #000;
            }
            .col-md-6 h4 {
                text-align: center;
                background-color: #f1f1f1;
                border-radius: 0px 0px 5px 5px;
                margin-top: 0px;
                font-size: 12px;
                padding: 8px;
            }
        </style>
@stop
