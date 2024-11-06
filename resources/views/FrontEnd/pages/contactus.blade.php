@extends('FrontEnd.layouts.master')
@section('content')


        <!-- Inner Banner -->
        <div class="inner-banner inner-banner-bg12">
            <div class="container">
                <div class="inner-title text-center">
                    <h3>{{trans('common.contactUs')}}</h3>
                    <ul>
                        <li>
                            <a href="{{url('/')}}">{{trans('common.PanelHome')}}</a>
                        </li>
                        <li>{{trans('common.contactUs')}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Contact Info Area -->
        <div class="contact-info-area pt-100 pb-70">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4  col-12 col-sm-8">
                        <div class="contact-info-card">
                            <i class="ri-map-pin-fill"></i>
                            <h3>{{trans('common.location')}} </h3>
                            <p>{{getSettingValue('address')}}
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6">
                        <div class="contact-info-card">
                            <i class="ri-mail-fill"></i>
                            <h3>{{trans('common.email')}}</h3>
                            <p><a href="mailto:{{getSettingValue('email')}}">{{getSettingValue('email')}}</a></p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-6">
                        <div class="contact-info-card">
                            <i class="ri-phone-fill"></i>
                            <h3>{{trans('common.phone')}}</h3>
                            @if (getSettingValue('phone') != '')
                                <p><a href="tel:{{getSettingValue('phone')}}">{{getSettingValue('phone')}}</a></p>
                            @endif
                            <p><a href="tel:{{getSettingValue('mobile')}}">{{getSettingValue('mobile')}}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Info Area End -->

        <!-- Contact Widget Area -->
        <div class="contact-widget-area pb-70">
            <div class="container">
                {{-- <div class="section-title text-center mb-45">
                    <span>{{trans('common.contactUs')}}</span>
                    <h2>لا تتردد أيداً في أن تتوصل معنا الآن</h2>
                </div> --}}
                <div class="contact-form">
                    @if (session()->get('success') != '')
                        <div class="alert alert-success">
                            {!!session()->get('success')!!}
                        </div>
                    @endif
                    <form class="theme-form" method="POST" action="{{ route('message.store') }}" id="Message_Form">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">{{ trans('common.name') }}</label>
                                    <span class="validity text-danger">*</span>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">{{ trans('common.email') }}</label>
                                    <span class="validity text-danger">*</span>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">{{ trans('common.phone') }}</label>
                                    <span class="validity text-danger">*</span>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">{{ trans('common.address') }}</label>
                                    <span class="validity text-danger">*</span>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" required>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="content">{{ trans('common.messageDetails') }}</label>
                                    <span class="validity text-danger">*</span>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="4"></textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <input type="submit" class="default-btn" value="{{ trans('common.Save changes') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Contact Widget Area End -->

        @if (getSettingValue('map') != '')
            <!-- Contact Map Area -->
            <div class="contact-map-area pb-100">
                <div class="container">
                    <div class="contact-map">
                        {!!getSettingValue('map')!!}
                    </div>
                </div>
            </div>
            <!-- Contact Map Area End -->
        @endif



@stop
