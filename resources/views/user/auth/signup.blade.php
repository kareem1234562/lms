@extends('FrontEnd.layouts.master')
@section('content')

        <!-- User Area -->
        <div class="user-area pt-100 pb-70">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6">
                        <div class="user-img">
                            <img src="{{asset('FrontendAssets/assets/images/login@4x.png')}}" alt="faq" class="w-75" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="user-all-form">
                            <div class="contact-form">
                                <h3 class="user-title">
                                    {{trans('common.Sign up')}}
                                </h3>
                                @if(session()->get('faild') != '')
                                    <div class="alert alert-danger py-2 text-center">
                                        {{session()->get('faild')}}
                                        {{session()->forget('faild')}}
                                    </div>
                                @endif
                                <form class="auth-login-form mt-2" action="{{ route('website.signup.submit') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 ">
                                            <div class="form-group">
                                                <label for="name" class="mb-1">{{trans('common.name')}}</label>
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="{{trans('common.name')}}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12 ">
                                            <div class="form-group">
                                                <label for="email" class="mb-1">{{trans('common.email')}}</label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{trans('common.email')}}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12 ">
                                            <div class="form-group">
                                                <label for="phone" class="mb-1">{{trans('common.phone')}}</label>
                                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" placeholder="{{trans('common.phone')}}" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password" class="mb-1">{{trans('common.password')}}</label>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            {!! Form::hidden('hp_field', '') !!}
                                            <button type="submit" class="default-btn">
                                                {{trans('common.Sign up')}}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Area End -->

@stop

@section('scripts')
    <style>
        .courses-item .content .course-instructors {
            width: 70px;
            height: 70px;
        }
        .courses-item .content .course-instructors img {
            height: 100%;
            width: 100%;
        }
    </style>
@endsection
