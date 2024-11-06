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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{trans('common.name')}}</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lessons as $lesson)
                                <tr id="row_{{$lesson->id}}">
                                    <td>
                                        {{$lesson['name_ar']}}<br>
                                        {{$lesson['name_en']}}
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:;" data-bs-target="#editlesson{{$lesson->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                            <i data-feather='edit'></i>
                                        </a>
                                        <?php $delete = route('admin.courses.lessons.delete',['courseId'=>$course->id,'lesson_id'=>$lesson->id]); ?>
                                        <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$lesson->id}}')">
                                            <i data-feather='trash-2'></i>
                                        </button>
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
            </div>

            <div class="col">

                <div class="divider">
                    <div class="divider-text">{{trans('learning.sections')}}</div>
                </div>

                <div class="accordion" id="accordionSections">
                    @forelse($sections as $section_key => $section_value)
                        <div class="card accordion-item mb-1" id="row_section{{$section_value->id}}">
                            <h2 class="accordion-header" id="headingOne">
                                <button
                                    type="button"
                                    class="accordion-button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#section{{$section_value['id']}}"
                                    aria-expanded="false"
                                    aria-controls="section{{$section_value['id']}}">
                                    {{$section_value['name_ar']}}
                                </button>
                            </h2>

                            <div
                                id="section{{$section_value['id']}}"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionSections">
                                <div class="accordion-body px-1">
                                    <div class="row">
                                        <div class="col text-center mb-1">
                                            <a href="javascript:;" data-bs-target="#editSection{{$section_value->id}}" data-bs-toggle="modal" class="btn btn-sm btn-info">
                                                {{trans('common.edit')}}
                                            </a>
                                            <?php $delete = route('admin.courses.sections.delete',['courseId'=>$course->id,'section_id'=>$section_value->id]); ?>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{$delete}}','{{$section_value->id}}')">
                                                {{trans('common.delete')}}
                                            </button>
                                        </div>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>{{trans('common.name')}}</th>
                                                <th class="text-center">{{trans('common.actions')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($section_value->lessons as $lesson)
                                                <tr id="row_{{$lesson->id}}">
                                                    <td>
                                                        {{$lesson['name_ar']}}<br>
                                                        {{$lesson['name_en']}}
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:;" data-bs-target="#editlesson{{$lesson->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                                            <i data-feather='edit'></i>
                                                        </a>
                                                        <?php $delete = route('admin.courses.lessons.delete',['courseId'=>$course->id,'lesson_id'=>$lesson->id]); ?>
                                                        <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$lesson->id}}')">
                                                            <i data-feather='trash-2'></i>
                                                        </button>
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
                                    @foreach($section_value->lessons as $lesson)

                                        <div class="modal fade text-md-start" id="editlesson{{$lesson->id}}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered modal-edit-user">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-transparent">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body pb-5 px-sm-5 pt-50">
                                                        <div class="text-center mb-2">
                                                            <h1 class="mb-1">{{trans('common.edit')}}: {{$lesson['name_'.session()->get('Lang')]}}</h1>
                                                        </div>
                                                        {{Form::open(['url'=>route('admin.courses.lessons.update',['courseId'=>$course->id,'lesson_id'=>$lesson->id]), 'id'=>'editlessonForm'.$lesson->id, 'class'=>'row gy-1 pt-75'])}}
                                                            <div class="col-12 col-md-12">
                                                                <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                                                                {{Form::text('name_ar',$lesson->name_ar,['id'=>'name_ar', 'class'=>'form-control'])}}
                                                            </div>
                                                            <div class="col-12 col-md-12">
                                                                <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                                                                {{Form::text('name_en',$lesson->name_en,['id'=>'name_en', 'class'=>'form-control'])}}
                                                            </div>
                                                            <div class="col-12"></div>
                                                            <div class="col-md-6 text-center">
                                                                <label class="form-label" for="lessonVideo">{{trans('learning.lessonVideo')}}</label>
                                                                <div class="file-loading">
                                                                    <input class="videofile" name="lessonVideo" type="file">
                                                                </div>
                                                                @if ($lesson->getVideoLink() != '')
                                                                    <video id="LessonVideo" width="100%">
                                                                        <source src="{{$lesson->getVideoLink()}}" type="video/mp4">
                                                                        Your browser does not support HTML5 video.
                                                                    </video>
                                                                    <a href="{{route('admin.courses.lessons.deleteVideo',[$lesson->course_id,$lesson->id])}}" class="btn btn-danger btn-block w-100">
                                                                        حذف
                                                                    </a>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <label class="form-label" for="lessonFile">{{trans('learning.lessonFile')}}</label>
                                                                <div class="file-loading">
                                                                    <input class="lessonFile" name="lessonFile" type="file">
                                                                </div>
                                                                @if ($lesson->getFileLink() != '')
                                                                    <a href="{{$lesson->getFileLink()}}" class="btn btn-info w-100 mb-1" target="_blank">
                                                                        استعراض الملف
                                                                    </a>
                                                                    <a href="{{route('admin.courses.lessons.deleteFile',[$lesson->course_id,$lesson->id])}}" class="btn btn-danger btn-block w-100">
                                                                        حذف
                                                                    </a>
                                                                @endif
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

                                </div>
                            </div>
                        </div>
                    @empty

                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- Bordered table end -->

    @foreach($lessons as $lesson)

        <div class="modal fade text-md-start" id="editlesson{{$lesson->id}}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <div class="text-center mb-2">
                            <h1 class="mb-1">{{trans('common.edit')}}: {{$lesson['name_'.session()->get('Lang')]}}</h1>
                        </div>
                        {{Form::open(['url'=>route('admin.courses.lessons.update',['courseId'=>$course->id,'lesson_id'=>$lesson->id]), 'id'=>'editlessonForm'.$lesson->id, 'class'=>'row gy-1 pt-75','files'=>'true'])}}
                            <div class="col-12 col-md-9">
                                <label class="form-label" for="name_ar">{{trans('common.title')}}</label>
                                {{Form::text('name_ar',$lesson->name_ar,['id'=>'name_ar', 'class'=>'form-control','required'])}}
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label" for="section">{{trans('learning.section')}}</label>
                                {{Form::select('section',[0=>trans('learning.noSection')] + $course->sectionsList(),$lesson->section,['id'=>'section', 'class'=>'selectpicker'])}}
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="price">{{trans('common.price')}}</label>
                                {{Form::number('price',$lesson->price,['id'=>'price', 'class'=>'form-control'])}}
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="the_order">{{trans('learning.the_order')}}</label>
                                {{Form::number('the_order',$lesson->the_order,['id'=>'the_order', 'class'=>'form-control'])}}
                            </div>
                            <div class="col-12"></div>
                            <div class="col-md-6 text-center">
                                <label class="form-label" for="lessonVideo">{{trans('learning.lessonVideo')}}</label>
                                <div class="file-loading">
                                    <input class="videofile" name="lessonVideo" type="file">
                                </div>
                                @if ($lesson->getVideoLink() != '')
                                    <video id="LessonVideo" width="100%">
                                        <source src="{{$lesson->getVideoLink()}}" type="video/mp4">
                                        Your browser does not support HTML5 video.
                                    </video>
                                    <a href="{{route('admin.courses.lessons.deleteVideo',[$lesson->course_id,$lesson->id])}}" class="btn btn-danger btn-block w-100">
                                        حذف
                                    </a>
                                @endif
                            </div>
                            <div class="col-md-6 text-center">
                                <label class="form-label" for="lessonFile">{{trans('learning.lessonFile')}}</label>
                                <div class="file-loading">
                                    <input class="lessonFile" name="lessonFile" type="file">
                                </div>
                                @if ($lesson->getFileLink() != '')
                                    <a href="{{$lesson->getFileLink()}}" class="btn btn-info w-100 mb-1" target="_blank">
                                        استعراض الملف
                                    </a>
                                    <a href="{{route('admin.courses.lessons.deleteFile',[$lesson->course_id,$lesson->id])}}" class="btn btn-danger btn-block w-100">
                                        حذف
                                    </a>
                                @endif
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

    @forelse($sections as $section_key => $section_value)

        <div class="modal fade text-md-start" id="editSection{{$section_value->id}}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <div class="text-center mb-2">
                            <h1 class="mb-1">{{trans('common.edit')}}: {{$section_value['name_'.session()->get('Lang')]}}</h1>
                        </div>
                        {{Form::open(['url'=>route('admin.courses.sections.update',['courseId'=>$course->id,'section_id'=>$section_value->id]), 'id'=>'editSectionForm'.$section_value->id, 'class'=>'row gy-1 pt-75'])}}
                            <div class="col-12 col-md-12">
                                <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                                {{Form::text('name_ar',$section_value->name_ar,['id'=>'name_ar', 'class'=>'form-control'])}}
                            </div>
                            <div class="col-12 col-md-12">
                                <label class="form-label" for="the_order">{{trans('learning.the_order')}}</label>
                                {{Form::number('the_order',$section_value->the_order,['id'=>'the_order', 'class'=>'form-control'])}}
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
    <a href="javascript:;" data-bs-target="#createbranch" data-bs-toggle="modal" class="btn btn-primary">
        {{trans('learning.CreateNewSection')}}
    </a>

    <div class="modal fade text-md-start" id="createbranch" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('learning.CreateNewSection')}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.courses.sections.store',['courseId'=>$course->id]), 'id'=>'createbranchForm', 'class'=>'row gy-1 pt-75'])}}
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                            {{Form::text('name_ar','',['id'=>'name_ar', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="the_order">{{trans('learning.the_order')}}</label>
                            {{Form::number('the_order',0,['id'=>'the_order', 'class'=>'form-control'])}}
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
    <a href="javascript:;" data-bs-target="#createLesson" data-bs-toggle="modal" class="btn btn-primary">
        {{trans('learning.CreateNewLesson')}}
    </a>

    <div class="modal fade text-md-start" id="createLesson" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('learning.CreateNewLesson')}}</h1>
                    </div>
                    {{Form::open(['url'=>'#', 'id'=>'createLessonForm', 'class'=>'row gy-1 pt-75','files'=>'true'])}}
                        <div class="col-12 col-md-9">
                            <label class="form-label" for="name_ar">{{trans('common.title')}}</label>
                            {{Form::text('name_ar','',['id'=>'name_ar', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="section">{{trans('learning.section')}}</label>
                            {{Form::select('section',[0=>trans('learning.noSection')] + $course->sectionsList(),'',['id'=>'section', 'class'=>'selectpicker'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="price">{{trans('common.price')}}</label>
                            {{Form::number('price',0,['id'=>'price', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="the_order">{{trans('learning.the_order')}}</label>
                            {{Form::number('the_order',0,['id'=>'the_order', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12"></div>
                        <div class="col-md-6 text-center">
                            <label class="form-label" for="lessonVideo">{{trans('learning.lessonVideo')}}</label>
                            <div class="file-loading">
                                <input class="videofile" name="lessonVideo" type="file" accept="video/*">
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <label class="form-label" for="lessonFile">{{trans('learning.lessonFile')}}</label>
                            <div class="file-loading">
                                <input class="lessonFile" name="lessonFile" type="file" accept="application/pdf">
                            </div>
                        </div>
                        <div class="col-12">
                            <div id="progress-bar" class="progress-bar" style="width: 0%; height: 20px; background-color: #4caf50; margin-top: 20px;"></div>
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
<script>
    document.getElementById('createLessonForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route('admin.courses.lessons.store', ['courseId' => $course->id]) }}', true);

        xhr.upload.onprogress = function(event) {
            if (event.lengthComputable) {
                var percentComplete = (event.loaded / event.total) * 100;
                document.getElementById('progress-bar').style.width = percentComplete + '%';
            }
        };

        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('File uploaded successfully');
                // Handle success case, maybe redirect or show a success message
                window.location.reload();
            } else {
                console.error('Error uploading file');
                // Handle error case
            }
        };

        xhr.send(formData);
    });
</script>
@stop
