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
                                <th class="text-center">الصورة</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr id="row_{{$event->id}}">
                                    <td>
                                        {{$event['title']}}
                                    </td>
                                    <td class="text-center">
                                        <img src="{{$event->photoLink()}}" alt="" height="60">
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('admin.events.clients',['id'=>$event->id])}}" class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="طلاب الورشة">
                                            <i data-feather='list'></i>
                                        </a>
                                        <a href="javascript:;" data-bs-target="#editevent{{$event->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                            <i data-feather='edit'></i>
                                        </a>
                                        <?php $delete = route('admin.events.delete',['id'=>$event->id]); ?>
                                        <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$event->id}}')">
                                            <i data-feather='trash-2'></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-3 text-center ">
                                        <h2>{{trans('common.nothingToView')}}</h2>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $events->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->

@foreach($events as $event)

    <div class="modal fade text-md-start" id="editevent{{$event->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.edit')}}: {{$event['name_'.session()->get('Lang')]}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.events.update',$event->id), 'id'=>'editeventForm'.$event->id, 'class'=>'row gy-1 pt-75','files'=>'true'])}}
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="title">{{trans('common.title')}}</label>
                            {{Form::text('title',$event->title,['id'=>'title', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="place">{{trans('common.place')}}</label>
                            {{Form::text('place',$event->place,['id'=>'place', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="date">التاريخ</label>
                            {{Form::date('date',$event->date,['id'=>'date', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="time">الوقت</label>
                            {{Form::time('time',$event->time,['id'=>'time', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="organizer">المنظم</label>
                            {{Form::text('organizer',$event->organizer,['id'=>'organizer', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12"></div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="details">تفاصيل</label>
                            {!!Form::textarea('details',$event->details,['id'=>'details', 'class'=>'form-control editor_ar'])!!}
                        </div>

                        <div class="col-12"></div>
                             
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12">
                                <label class="form-label" for="photo">صورة</label>
                                <div class="file-loading"> 
                                    <input class="files" name="photo" type="file">
                                </div>
                                <img src="{{$event->photoLink()}}" alt="" height="60">
                            </div>
                        </div>
                        <div class="col-12 text-center mt-2 pt-50">
                            <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                {{trans('common.Cancel')}}
                            </button>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endforeach

@stop

@section('page_buttons')
    <a href="javascript:;" data-bs-target="#createcourse" data-bs-toggle="modal" class="btn btn-primary">
        {{trans('common.CreateNew')}}
    </a>

    <div class="modal fade text-md-start" id="createcourse" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.events.store'), 'id'=>'createcourseForm', 'class'=>'row gy-1 pt-75','files'=>'true'])}}
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="title">{{trans('common.title')}}</label>
                            {{Form::text('title','',['id'=>'title', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="place">{{trans('common.place')}}</label>
                            {{Form::text('place','',['id'=>'place', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="date">التاريخ</label>
                            {{Form::date('date','',['id'=>'date', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="time">الوقت</label>
                            {{Form::time('time','',['id'=>'time', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="organizer">المنظم</label>
                            {{Form::text('organizer','',['id'=>'organizer', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12"></div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="details">تفاصيل</label>
                            {{Form::textarea('details','',['id'=>'details', 'class'=>'form-control editor_ar'])}}
                        </div>
                        <div class="col-12"></div>

                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12">
                                <label class="form-label" for="photo">صورة</label>
                                <div class="file-loading"> 
                                    <input class="files" name="photo" type="file">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-2 pt-50">
                            <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                {{trans('common.Cancel')}}
                            </button>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script src="{{asset('AdminAssets/app-assets/js/scripts/pages/modal-add-course.js')}}"></script>
@stop