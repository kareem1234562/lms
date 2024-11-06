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
                            الفعاليات / ورش العمل
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Events Area -->
        <div class="event-area pt-100 pb-100">
            <div class="container">
                <div class="section-title text-center mb-45">
                    <h2>الفعاليات التي سيتم تنفيذها</h2>
                </div>
                <div class="row">
                    @foreach ($events as $event)
                        <div class="col-lg-6">
                            <div class="event-item box-shadow">
                                <div class="event-img">
                                    <a href="{{route('website.events.details',$event->id)}}">
                                        <img src="{{$event->photoLink()}}" alt="{{$event->title}}" />
                                    </a>
                                </div>
                                <div class="event-content">
                                    <ul class="event-list">
                                        <li><i class="ri-calendar-todo-fill"></i> {{$event->date}}</li>
                                        <li><i class="ri-map-pin-fill"></i> {{$event->place}}</li>
                                        <li><i class="ri-time-fill"></i> {{$event->time}}</li>
                                    </ul>
                                    <h3>
                                        <a href="{{route('website.events.details',$event->id)}}">
                                            {{$event->title}}
                                        </a>
                                    </h3>
                                    <p>{{strip_tags(\Illuminate\Support\Str::words($event->details, 10))}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                    <div class="col-lg-12 col-md-12 text-center">
                        <div class="pagination-area">
							{{$events->links()}}
						</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Events Area End -->

@stop