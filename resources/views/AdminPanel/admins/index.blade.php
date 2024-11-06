@extends('AdminPanel.layouts.master')
@section('content')


    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$title}}</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-2">
                        <thead>
                            <tr>
                                <th>{{trans('common.name')}}</th>
                                <th>{{trans('common.contacts')}}</th>
                                <th>{{trans('common.role')}}</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr id="row_{{$user->id}}">
                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    {{$user->email}}
                                    <br>
                                    {{$user->phone}}
                                </td>
                                <td class="text-center text-nowrap">
                                    {{$user->hisRole['name_'.Session::get('Lang')] ?? ''}}
                                </td>
                                <td class="text-center text-nowrap">
                                    @if($user->id != 1)
                                        <a href="{{route('admin.adminUsers.resetIP',['id'=>$user->id])}}" class="btn btn-md btn-info">
                                            إعادة تعيين الجهاز
                                        </a>
                                        @if($user->status == 'Active')
                                            <a href="{{route('admin.adminUsers.block',['id'=>$user->id,'action'=>'1'])}}" class="btn btn-icon btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.block')}}">
                                                <i data-feather='shield-off'></i>
                                            </a>
                                        @else
                                            <a href="{{route('admin.adminUsers.block',['id'=>$user->id,'action'=>'0'])}}" class="btn btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.unblock')}}">
                                                <i data-feather='shield'></i>
                                            </a>
                                        @endif
                                        <a href="{{route('admin.adminUsers.edit',['id'=>$user->id])}}" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                            <i data-feather='edit'></i>
                                        </a>
                                        <?php $delete = route('admin.adminUsers.delete',['id'=>$user->id]); ?>
                                        <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$user->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
                                            <i data-feather='trash-2'></i>
                                        </button>
                                        <?php /*
                                        <a href="" class="btn btn-icon btn-danger">

                                        </a>
                                        */ ?>
                                    @else
                                        @if(auth()->user()->id == 1)
                                            <a href="{{route('admin.adminUsers.edit',['id'=>$user->id])}}" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                                <i data-feather='edit'></i>
                                            </a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-3 text-center ">
                                        <h2>{{trans('common.nothingToView')}}</h2>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $users->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->



@stop

@section('page_buttons')
    @if(!isset($_GET['status']) || (isset($_GET['status']) && $_GET['status'] != 'Archive'))
        <a href="{{route('admin.adminUsers',['status'=>'Archive'])}}" class="btn btn-danger">
            {{trans('common.Archive')}}
        </a>
    @endif
    @if(isset($_GET['status']) && $_GET['status'] != 'Active')
        <a href="{{route('admin.adminUsers',['status'=>'Active'])}}" class="btn btn-success">
            {{trans('common.ActiveUsers')}}
        </a>
    @endif
    <?php
        $create_params = [];
        if ($active == 'clients') {
            $create_params['role'] = 3;
        }
        if ($active == 'instructors') {
            $create_params['role'] = 2;
        }
    ?>
    <a href="{{route('admin.adminUsers.create',$create_params)}}" class="btn btn-primary">
        {{trans('common.CreateNew')}}
    </a>
@stop
