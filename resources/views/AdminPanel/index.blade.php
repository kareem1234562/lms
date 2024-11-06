@extends('AdminPanel.layouts.master')

@section('content')

@if (auth()->user()->role == 2)
    @include('AdminPanel.teacher-home')
@endif

    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            @if(userCan('view_home_stats'))
                <!--/ Line Chart -->
                <div class="col-lg-12 col-12">
                    <div class="card card-statistics">
                        <div class="card-header">
                            <h4 class="card-title">{{trans('common.Statistics')}}</h4>
                            <div class="d-flex align-items-center">
                                <p class="card-text me-25 mb-0">{{trans('common.thisMonthStatistics')}}</p>
                            </div>
                        </div>
                        <div class="card-body statistics-body">
                            <div class="row justify-content-center">
                                <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-primary me-1">
                                            <div class="avatar-content">
                                                <i data-feather="user" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">
                                                <a href="{{route('admin.clients',['time'=>'today'])}}">
                                                    {{number_format(homeStates()['todayClients'])}}
                                                </a>
                                            </h4>
                                            <p class="card-text font-small-3 mb-0">عملاء اليوم</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-primary me-1">
                                            <div class="avatar-content">
                                                <i data-feather="user" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">{{number_format(homeStates()['monthClients'])}}</h4>
                                            <p class="card-text font-small-3 mb-0">{{trans('common.newClients')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6 col-12 mb-2 mb-md-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-success me-1">
                                            <div class="avatar-content">
                                                <i data-feather="user" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">{{number_format(homeStates()['monthCurrentClients'])}}</h4>
                                            <p class="card-text font-small-3 mb-0">عميل حالي</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
    <!-- Dashboard Analytics end -->


@stop
