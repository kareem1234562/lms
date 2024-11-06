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
                                    {{trans('common.Sign in')}}
                                </h3>
                                @if(session()->get('success') != '')
                                    <div class="alert alert-success py-2 text-center">
                                        {{session()->get('success')}}
                                    </div>
                                @endif
                                @if(session()->get('faild') != '')
                                    <div class="alert alert-danger py-2 text-center">
                                        {{session()->get('faild')}}
                                        {{session()->forget('faild')}}
                                    </div>
                                @endif
                                <?php $coins = 0; ?>
                                @if(session()->get('coins') != '')
                                    @if (session()->get('coins') > 0)
                                        <?php $coins += session()->get('coins'); ?>
                                        <div class="alert alert-success py-2 text-center">
                                            {{trans('common.CoinsSuccess')}}
                                        </div>
                                    @else
                                        <div class="alert alert-danger py-2 text-center">
                                            {{trans('common.CoinsFaild')}}
                                        </div>
                                    @endif
                                    {{session()->forget('coins')}}
                                @endif
                                <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    {!! Form::hidden('coins', $coins) !!}
                                    <div class="row">
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

                                        <div class="col-12">
                                            <label for="password" class="mb-1">{{trans('common.password')}}</label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" id="passwordInput" placeholder="Password" name="password">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                        <i class="far fa-eye" id="eyeIcon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 form-condition">
                                            <div class="agree-label">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label for="remember">
                                                    {{trans('common.Remember Me')}}
                                                    <a class="forget" href="{{route('password.request')}}">
                                                        {{trans('common.Forgot Password?')}}
                                                    </a>
                                                    |
                                                    <a class="" href="{{route('website.signup')}}">
                                                        {{trans('common.Sign up')}}
                                                    </a>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <button type="submit" class="default-btn">
                                                {{trans('common.Sign in')}}
                                            </button>
                                            أو

                                            <a href="{{route('auth.google.redirect')}}" class="default-btn">
                                                google
                                            </a>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

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
    <script>
        $(document).ready(function() {
          $("#togglePassword").click(function() {
            var passwordInput = $("#passwordInput");
            var eyeIcon = $("#eyeIcon");
            if (passwordInput.attr("type") === "password") {
              passwordInput.attr("type", "text");
              eyeIcon.removeClass("far fa-eye").addClass("far fa-eye-slash");
            } else {
              passwordInput.attr("type", "password");
              eyeIcon.removeClass("far fa-eye-slash").addClass("far fa-eye");
            }
          });
        });
      </script>
@endsection
