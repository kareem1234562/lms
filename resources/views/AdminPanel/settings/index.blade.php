@extends('AdminPanel.layouts.master')
@section('content')


    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            {{Form::open(['url'=>route('admin.settings.update'), 'files'=>'true'])}}
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general" aria-controls="home" role="tab" aria-selected="true">
                                <i data-feather="home"></i> {{trans('common.generalSettings')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="aboutus-tab" data-bs-toggle="tab" href="#aboutus" aria-controls="home" role="tab" aria-selected="true">
                                <i data-feather="book"></i> {{trans('common.aboutusSettings')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="images-tab" data-bs-toggle="tab" href="#images" aria-controls="home" role="tab" aria-selected="true">
                                <i data-feather="camera"></i> {{trans('common.imagesSettings')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="coins-tab" data-bs-toggle="tab" href="#coins" aria-controls="coins" role="tab" aria-selected="true">
                                <i data-feather="dollar-sign"></i> {{trans('learning.coinsSettings')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" aria-controls="contact" role="tab" aria-selected="false">
                                <i data-feather="tool"></i> {{trans('common.contactSettings')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="payment_method-tab" data-bs-toggle="tab" href="#payment_method" aria-controls="payment_method" role="tab" aria-selected="false">
                                <i data-feather='dollar-sign'></i> {{trans('common.payment_method')}}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="general" aria-labelledby="general-tab" role="tabpanel">
                            @include('AdminPanel.settings.includes.general')
                        </div>
                        <div class="tab-pane" id="aboutus" aria-labelledby="aboutus-tab" role="tabpanel">
                            @include('AdminPanel.settings.includes.aboutus')
                        </div>
                        <div class="tab-pane" id="images" aria-labelledby="images-tab" role="tabpanel">
                            @include('AdminPanel.settings.includes.images')
                        </div>
                        <div class="tab-pane" id="contact" aria-labelledby="contact-tab" role="tabpanel">
                            @include('AdminPanel.settings.includes.contact')
                        </div>
                        <div class="tab-pane" id="coins" aria-labelledby="coins-tab" role="tabpanel">
                            @include('AdminPanel.settings.includes.coins')
                        </div>
                        <div class="tab-pane" id="payment_method" aria-labelledby="payment_method-tab" role="tabpanel">
                            @include('AdminPanel.settings.includes.payment_method')
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{trans('common.Save changes')}}" class="btn btn-primary">
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
    <!-- Bordered table end -->
@stop
