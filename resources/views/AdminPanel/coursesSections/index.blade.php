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
                                {{-- <th class="text-center">الأيقونة</th>
                                <th class="text-center">الصورة</th> --}}
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sections as $section)
                                <tr id="row_{{$section->id}}">
                                    <td>
                                        {{$section['name_ar']}}
                                        @if ($section['name_en'] != '')
                                            <br>
                                            {{$section['name_en']}}
                                        @endif
                                    </td>
                                    {{-- <td class="text-center">
                                        {{$section['icon']}}
                                    </td>
                                    <td class="text-center">
                                        <img src="{{$section->photoLink()}}" alt="" height="60">
                                    </td> --}}
                                    <td class="text-center">
                                        <a href="javascript:;" data-bs-target="#editcourse{{$section->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                            <i data-feather='edit'></i>
                                        </a>
                                        <?php $delete = route('admin.coursesSections.delete',['id'=>$section->id]); ?>
                                        <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$section->id}}')">
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

                {{ $sections->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->

@foreach($sections as $section)

    <div class="modal fade text-md-start" id="editcourse{{$section->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.edit')}}: {{$section['name_'.session()->get('Lang')]}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.coursesSections.update',$section->id), 'id'=>'editcourseForm'.$section->id, 'class'=>'row gy-1 pt-75','files'=>'true'])}}
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                            {{Form::text('name_ar',$section->name_ar,['id'=>'name_ar', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                            {{Form::text('name_en',$section->name_en,['id'=>'name_en', 'class'=>'form-control'])}}
                        </div>
                        {{-- <div class="col-12 col-md-4">
                            <label class="form-label" for="icon">الأيقونة</label>
                            {{Form::select('icon',iconsList(),$section->icon,['id'=>'icon', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12"></div>

                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12">
                                <label class="form-label" for="photo">صورة</label>
                                <div class="file-loading">
                                    <input class="files" name="photo" type="file">
                                </div>
                                <img src="{{$section->photoLink()}}" alt="" height="60">
                            </div>
                        </div> --}}
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
                    {{Form::open(['url'=>route('admin.coursesSections.store'), 'id'=>'createcourseForm', 'class'=>'row gy-1 pt-75','files'=>'true'])}}
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                            {{Form::text('name_ar','',['id'=>'name_ar', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                            {{Form::text('name_en','',['id'=>'name_en', 'class'=>'form-control'])}}
                        </div>
                        {{-- <div class="col-12 col-md-4">
                            <label class="form-label" for="icon">الأيقونة</label>
                            {{Form::select('icon',iconsList(),'',['id'=>'icon', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12"></div>

                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12">
                                <label class="form-label" for="photo">صورة</label>
                                <div class="file-loading">
                                    <input class="files" name="photo" type="file">
                                </div>
                            </div>
                        </div> --}}
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
