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
                                <th class="text-center">الرقم</th>
                                <th class="text-center">الصوره</th>

                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($chapters as $chapter)
                                <tr id="row_{{$chapter->id}}">
                                    <td>
                                        {{$chapter->name}}
                                    </td>
                                    <td class="text-center">
                                        {{$chapter->number}}
                                    </td>
                                    <td class="text-center">
                                        <img src="{{asset('uploads/chapters/'.$chapter->icon)}}" alt="no" width="100" style="border-radius: 100%;" >
                                    </td>

                                    <td class="text-center">

                                    <a href="{{route('admin.courses.chapter.lessons',$chapter->id)}}" class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('learning.lessons')}}">
                                            <i data-feather='list'></i>
                                        </a>


                                        <a href="javascript:;" data-bs-target="#editchapter{{$chapter->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                            <i data-feather='edit'></i>
                                        </a>


                                            <?php $delete = route('admin.chapter.delete',['id'=>$chapter->id]); ?>
                                            <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$chapter->id}}')">
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

                {{ $chapters->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->

@foreach($chapters as $chapter)
@if ($errors->hasBag('editchapter' . $chapter->id) && $errors->getBag('editchapter' . $chapter->id)->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('editchapter{{ $chapter->id }}'));
        modal.show();
    });
</script>
@endif

    <div class="modal fade text-md-start" id="editchapter{{$chapter->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.edit')}}: {{$chapter['name_'.session()->get('Lang')]}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.chapter.update',$chapter->id), 'id'=>'editchapterForm'.$chapter->id, 'class'=>'row gy-1 pt-75','files'=>'true'])}}
                    <div class="col-12 col-md-8">
                            <label class="form-label" for="name">{{trans('common.name')}}</label>
                            {{Form::text('name',$chapter->name,['id'=>'name', 'class'=>'form-control','required'])}}
                        </div>

                        <div class="col-12 col-md-8">
                            <label class="form-label" for="number">{{trans('رقم الشابتر')}}</label>
                            {{Form::text('number',$chapter->number,['id'=>'number', 'class'=>'form-control','required'])}}
                            @if ($errors->hasBag('editchapter' . $chapter->id) && $errors->getBag('editchapter' . $chapter->id)->has('number'))
                            <span class="text-danger">{{ $errors->getBag('editchapter' . $chapter->id)->first('number') }}</span>
                          @endif
                        </div>
                        <!-- @if ($active != 'curriculums')
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="section_id">القسم</label>
                                {{Form::select('section_id',sectionsList(),'',['id'=>'section_id', 'class'=>'selectpicker'])}}
                            </div>
                        @endif -->


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
                                    <img src="{{asset('uploads/chapters/'.$chapter->icon)}}" class="img-fluid" style="width: 100px">
                                </div>
                                <div class="file-loading">
                                    <input class="files" name="icon" type="file">
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
                    {{Form::open(['url'=>route('admin.courses.chapters.store',['id'=>$course_id]), 'id'=>'createcourseForm', 'class'=>'row gy-1 pt-75','files'=>'true'])}}


                        <div class="col-12 col-md-8">
                            <label class="form-label" for="name">{{trans('common.name')}}</label>
                            {{Form::text('name','',['id'=>'name', 'class'=>'form-control','required'])}}
                            @if ($errors->createcourse->has('name'))
                                <span class="text-danger">{{ $errors->createcourse->first('name') }}</span>
                            @endif
                        </div>

                        <div class="col-12 col-md-8">
                            <label class="form-label" for="number">{{trans('رقم الشابتر')}}</label>
                            {{Form::text('number','',['id'=>'number', 'class'=>'form-control','required'])}}
                            @if ($errors->createcourse->has('number'))
                                <span class="text-danger">{{ $errors->createcourse->first('number') }}</span>
                            @endif
                        </div>
                        <!-- @if ($active != 'curriculums')
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="section_id">القسم</label>
                                {{Form::select('section_id',sectionsList(),'',['id'=>'section_id', 'class'=>'selectpicker'])}}
                            </div>
                        @endif -->


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
                                    <input class="files" name="icon" type="file">
                                </div>
                                @if ($errors->createcourse->has('icon'))
                                <span class="text-danger">{{ $errors->createcourse->first('icon') }}</span>
                            @endif
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
