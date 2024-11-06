@extends('AdminPanel.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <!-- profile -->
            <div class="card">
                <div class="card-body py-2 my-25">
                    {{Form::open(['files'=>'true','class'=>'validate-form'])}}
                        <input autocomplete="false" name="hidden" type="text" style="display:none;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="divider">
                                    <div class="divider-text">{{trans('common.profilePhoto')}}</div>
                                </div>

                                <span class="avatar mb-2">
                                    <img class="round" src="{{$user->photoLink()}}" alt="avatar" height="150" width="150">
                                </span>
                                <div class="file-loading">
                                    <input class="files" name="profile_photo" type="file">
                                </div>
                                @if($errors->has('profile_photo'))
                                    <span class="text-danger" role="alert">
                                        <b>{{ $errors->first('profile_photo') }}</b>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="divider">
                                    <div class="divider-text">{{trans('common.loginData')}}</div>
                                </div>

                                <div class="row pt-3">
                                    <div class="col-12 col-sm-4 mb-1">
                                        <label class="form-label" for="name">{{trans('common.name')}}</label>
                                        {{Form::text('name',$user->name,['id'=>'name','class'=>'form-control','required'])}}
                                        @if($errors->has('name'))
                                            <span class="text-danger" role="alert">
                                                <b>{{ $errors->first('name') }}</b>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-12 col-sm-4 mb-1">
                                        <label class="form-label" for="username">{{trans('common.username')}}</label>
                                        {{Form::text('username',$user->username,['id'=>'username','class'=>'form-control'])}}
                                    </div>
                                    <div class="col-12 col-sm-4 mb-1">
                                        <label class="form-label" for="email">{{trans('common.email')}}</label>
                                        {{Form::email('email',$user->email,['id'=>'email','class'=>'form-control'])}}
                                        @if($errors->has('email'))
                                            <span class="text-danger" role="alert">
                                                <b>{{ $errors->first('email') }}</b>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-12 col-sm-4 mb-1">
                                        <label class="form-label" for="phone">{{trans('common.personalPhone')}}</label>
                                        {{Form::text('phone',$user->phone,['id'=>'phone','class'=>'form-control'])}}
                                        @if($errors->has('phone'))
                                            <span class="text-danger" role="alert">
                                                <b>{{ $errors->first('phone') }}</b>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-12 col-sm-4 mb-1">
                                        <label class="form-label" for="phone">{{trans('common.password')}}</label>
                                        {{Form::password('password',['id'=>'phone','class'=>'form-control','autoComplete'=>'new-password'])}}
                                    </div>
                                    @if(userCan('users_create'))
                                        <div class="col-12 col-sm-4 mb-1">
                                            <label class="form-label" for="role">{{trans('common.role')}}</label>
                                            {{Form::select('role',getRolesList(session()->get('Lang'),'id','admin'),$user->role,['id'=>'role','class'=>'selectpicker','data-live-search'=>'true'])}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($user->role == '2')
                            <div class="divider">
                                <div class="divider-text">{{trans('common.MainProfileData')}}</div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-1">
                                    <label class="form-label" for="bio">{{trans('common.details')}}</label>
                                    {{Form::textarea('bio',$user->bio,['id'=>'bio','class'=>'form-control editor_ar'])}}
                                </div>
                            </div>
                        @endif




                        <!-- form -->
                        <div class="row pt-3">

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mt-1 me-1">{{trans('common.Save changes')}}</button>
                            </div>
                        </div>
                        <!--/ form -->
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@stop
