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
                            <th class="text-center">الاسم</th>
                            <th class="text-center">الصوره</th>

                            <th class="text-center">{{trans('common.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lessons as $lesson)
                        <tr id="row_{{$lesson->id}}">
                            <td>
                                {{$lesson->name}}
                            </td>
                            <td class="text-center">
                                {{$lesson->number}}
                            </td>
                            <td class="text-center">
                                <img src="{{asset('uploads/lessons/icons/'.$lesson->icon)}}" alt="no" width="100" style="border-radius: 100%;">
                            </td>



                            <td class="text-center">

                                  <a href="{{route('newcourse.quizes.lesson_quiz2.index',$lesson->id)}}" class="btn btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('Quiz')}}">
                                            <i data-feather='list'></i>
                                        </a>
                                <a href="javascript:;" data-bs-target="#editchapter{{$lesson->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                    <i data-feather='edit'></i>
                                </a>

                                <?php $delete = route('admin.courses2.lessons.delete', ['id' => $lesson->id]); ?>
                                <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$lesson->id}}')">
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

            {{ $lessons->links('vendor.pagination.default') }}


        </div>
    </div>
</div>
<!-- Bordered table end -->

@foreach($lessons as $lesson)
@if ($errors->hasBag('editchapter' . $lesson->id) && $errors->getBag('editchapter' . $lesson->id)->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('editchapter{{ $lesson->id }}'));
        modal.show();
    });
</script>
@endif
<div class="modal fade text-md-start" id="editchapter{{$lesson->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">{{trans('common.edit')}}: {{$lesson['name_'.session()->get('Lang')]}}</h1>
                </div>
                {{Form::open(['url'=>route('admin.courses2.lessons.update',$lesson->id), 'id'=>'editchapterForm'.$lesson->id, 'class'=>'row gy-1 pt-75','files'=>'true'])}}
                <div class="col-12 col-md-8">
                    <label class="form-label" for="name">{{trans('common.name')}}</label>
                    {{Form::text('name',$lesson->name,['id'=>'name', 'class'=>'form-control','required'])}}

                </div>

                <div class="col-12 col-md-8">
                    <label class="form-label" for="number">{{trans('رقم الحصه')}}</label>
                    {{Form::number('number',$lesson->number,['id'=>'number', 'class'=>'form-control','required'])}}
                    @if ($errors->hasBag('editchapter' . $lesson->id) && $errors->getBag('editchapter' . $lesson->id)->has('number'))
                            <span class="text-danger">{{ $errors->getBag('editchapter' . $lesson->id)->first('number') }}</span>
                        @endif
                </div>


        <div class="col-12 col-md-6">
                            <label class="form-label" for="chapter_id">{{trans('chapters')}}</label>
                            {{Form::select('chapter_id',[''=>'no chapter']+$chapters,json_decode($lesson->chapter_id),['id'=>'Instructors', 'class'=>'selectpicker'])}}
                        </div>

                <div class="col-12 col-md-8">
                    <label class="form-label" for="stream_link">{{trans('streamlink')}}</label>
                    {{Form::text('stream_link',$lesson->stream_link,['id'=>'stream_link', 'class'=>'form-control','required'])}}
                </div>



                <!-- <div class="col-12"></div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="details_ar">{{trans('common.des_ar')}}</label>
                            {!!Form::textarea('details_ar','',['id'=>'details_ar', 'class'=>'form-control editor_ar'])!!}
                        </div> -->
                <!-- <div class="col-12 col-md-12">
                            <label class="form-label" for="details_en">{{trans('common.des_en')}}</label>
                            {!!Form::textarea('details_en','',['id'=>'details_en', 'class'=>'form-control editor_ar'])!!}
                        </div> -->

                <!-- <div class="col-12 col-md-12">
                            <label class="form-label" for="seo_keywords">SEO الكلمات الدليلية</label>
                            {!!Form::textarea('seo_keywords','',['id'=>'seo_keywords', 'class'=>'form-control','rows'=>'3'])!!}
                        </div> -->

                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <label class="form-label" for="icon">صورة العرض على الموقع</label>
                        <div>
                        <img src="{{asset('uploads/lessons/icons/'.$lesson->icon)}}" alt="no" width="100" style="border-radius: 100%;">
                        </div>
                        <div class="file-loading">
                            <input class="files" name="icon" type="file" >
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <label class="form-label" for="video">فيديو العرض على الموقع</label>
                        <div>
                        <img src="{{asset('uploads/lessons/video/'.$lesson->icon)}}" alt="no" width="100" style="border-radius: 100%;">
                        </div>
                        <div class="file-loading">
                            <input class="files" name="video" type="file" >
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <label class="form-label" for="file">الملف العرض على الموقع</label>
                        <div>
                        <img src="{{asset('uploads/lessons/files/'.$lesson->icon)}}" alt="no" width="100" style="border-radius: 100%;">
                        </div>
                        <div class="file-loading">
                            <input class="files" name="file" type="file" >
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

@endforeach

@stop

@section('page_buttons')
@if ($active != 'curriculums')

<a href="{{route('admin.newCourse.instructors')}}" class="btn btn-primary btn-sm">
    المحاضرين
</a>
@endif
<a href="javascript:;" data-bs-target="#createcourse" data-bs-toggle="modal" class="btn btn-primary btn-sm">
    {{trans('common.CreateNew')}}
</a>

@if ($errors->createcourse->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('createcourse'));
        modal.show();
    });
</script>
@endif

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
                {{Form::open(['url'=>route('admin.courses2.lessons.store',$course_id), 'id'=>'createcourseForm', 'class'=>'row gy-1 pt-75','files'=>'true'])}}


                <div class="col-12 col-md-8">
                    <label class="form-label" for="name">{{trans('common.name')}}</label>
                    {{Form::text('name','',['id'=>'name', 'class'=>'form-control','required'])}}
                </div>

                <div class="col-12 col-md-8">
                    <label class="form-label" for="number">{{trans('رقم الحصه')}}</label>
                    {{Form::text('number','',['id'=>'number', 'class'=>'form-control','required'])}}
                    @if ($errors->createcourse->has('number'))
                                <span class="text-danger">{{ $errors->createcourse->first('number') }}</span>
                            @endif
                </div>



                        <div class="col-12 col-md-4">
            <label class="form-label" for="chapter_id">('اختيارى') اختر واحد فقط</label>
            <select id="chapter_id" name="chapter_id" class="selectpicker" required>
                <option value="" selected disabled>اختر واحدًا</option>
                <option value=""  > لا ينتمى لاي شابتر</option>
                @foreach ($chapters as $id => $number)
                    <option value="{{ $id }}">{{ $number }}</option>
                @endforeach
            </select>
        </div>

                <div class="col-12 col-md-8">
                    <label class="form-label" for="stream_link">{{trans('streamlink')}}</label>
                    {{Form::text('stream_link','',['id'=>'stream_link', 'class'=>'form-control','required'])}}
                </div>



                <!-- <div class="col-12"></div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="details_ar">{{trans('common.des_ar')}}</label>
                            {!!Form::textarea('details_ar','',['id'=>'details_ar', 'class'=>'form-control editor_ar'])!!}
                        </div> -->
                <!-- <div class="col-12 col-md-12">
                            <label class="form-label" for="details_en">{{trans('common.des_en')}}</label>
                            {!!Form::textarea('details_en','',['id'=>'details_en', 'class'=>'form-control editor_ar'])!!}
                        </div> -->

                <!-- <div class="col-12 col-md-12">
                            <label class="form-label" for="seo_keywords">SEO الكلمات الدليلية</label>
                            {!!Form::textarea('seo_keywords','',['id'=>'seo_keywords', 'class'=>'form-control','rows'=>'3'])!!}
                        </div> -->

                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <label class="form-label" for="icon">صورة العرض على الموقع</label>
                        <div class="file-loading">
                            <input class="files" name="icon" type="file" required>
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <label class="form-label" for="video">فيديو العرض على الموقع</label>
                        <div class="file-loading">
                            <input class="files" name="video" type="file" required>
                        </div>
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <label class="form-label" for="file">الملف العرض على الموقع</label>
                        <div class="file-loading">
                            <input class="files" name="file" type="file" required>
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
