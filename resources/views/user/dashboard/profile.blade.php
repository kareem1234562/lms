@extends('FrontEnd.layouts.master')
@section('content')

<div class="container pt-4">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                @include('user.dashboard.includes.sidebar')
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">


                        @if(session()->get('success') != '')
                            <div class="alert alert-success py-2 text-center">
                                {{session()->get('success')}}
                            </div>
                            {{session()->forget('success')}}
                        @endif

                        {{Form::open(['files'=>'true','class'=>'validate-form'])}}
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-3 text-center">
                                    <span class="avatar mb-2">
                                        <img class="round" src="{{auth()->user()->photoLink()}}" alt="avatar" height="150" width="150">
                                    </span>
                                    <div class="file-loading">
                                        <input class="files" name="photo" type="file">
                                    </div>
                                </div>
                            </div>

                            <!-- form -->
                            <div class="row pt-3">
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label" for="name">{{trans('common.name')}}</label>
                                    {{Form::text('name',auth()->user()->name,['id'=>'name','class'=>'form-control','required'])}}
                                </div>
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label" for="userName">{{trans('common.username')}}</label>
                                    {{Form::text('userName',auth()->user()->userName,['id'=>'userName','class'=>'form-control'])}}
                                </div>
                                <div class="col-12 col-sm-3 mb-1">
                                    <label class="form-label" for="email">{{trans('common.email')}}</label>
                                    {{Form::text('email',auth()->user()->email,['id'=>'email','class'=>'form-control','required'])}}
                                </div>

                                <?php /*
                                <div class="col-12 col-sm-3 mb-1">
                                    <label for="language" class="form-label">{{trans('common.language')}}</label>
                                    {{Form::select('language',[
                                                                'ar' => trans('common.lang1Name'),
                                                                'en' => trans('common.lang2Name'),
                                                                'fr' => trans('common.lang3Name')
                                                                ],auth()->user()->language,['id'=>'language','class'=>'form-control selectpicker'])}}
                                </div>
                                <div class="col-12 col-sm-3 mb-1">
                                    <label class="form-label" for="country">{{trans('common.country')}}</label>
                                    {{Form::select('country',getCountriesList(session()->get('Lang'),'id'),auth()->user()->country,['id'=>'country','class'=>'form-control selectpicker','data-live-search'=>'true'])}}
                                </div>
                                */ ?>
                                <div class="col-12 col-sm-3 mb-1">
                                    <label class="form-label" for="phone">{{trans('common.phone')}}</label>
                                    {{Form::text('phone',auth()->user()->phone,['id'=>'phone','class'=>'form-control'])}}
                                </div>
                                <div class="col-12 col-sm-3 mb-1">
                                    <label class="form-label" for="password">{{trans('common.password')}}</label>
                                    {{Form::password('password',['id'=>'password','class'=>'form-control'])}}
                                    @if($errors->has('password'))
                                        <span class="text-danger" role="alert">
                                            <b>{{ $errors->first('password') }}</b>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-12 col-sm-3 mb-1">
                                    <label class="form-label" for="passwordConfirmation">{{trans('common.passwordConfirmation')}}</label>
                                    {{Form::password('password_confirmation',['id'=>'passwordConfirmation','class'=>'form-control'])}}
                                </div>

                                <div class="col-12 col-sm-12 mb-1">
                                    <label class="form-label" for="address">{{trans('common.address')}}</label>
                                    {{Form::text('address',auth()->user()->address,['id'=>'address','class'=>'form-control'])}}
                                </div>


                                <!-- form -->
                                <div class="row pt-1">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mt-1 me-1">{{trans('common.Save changes')}}</button>
                                    </div>
                                </div>
                                <!--/ form -->
                            </div>
                            <!--/ form -->
                        {{Form::close()}}

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
