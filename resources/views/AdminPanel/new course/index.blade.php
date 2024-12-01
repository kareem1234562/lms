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
                                <th class="text-center">السعر</th>
                                <th class="text-center">الصوره</th>
                                <th class="text-center">فيديو</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($courses as $course)
                                <tr id="row_{{$course->id}}">
                                    <td>
                                        {{$course->name}}
                                    </td>
                                    <td class="text-center">
                                        {{$course->price}}
                                    </td>
                                    <td >
                                        <img src="{{asset('uploads/courses/'.$course->photo)}}" alt="no" width="100">
                                    </td>
                                    <td style="display: flex; justify-content:center;align-items: center">
                                       @if ($course->Explanatory_Video)
                                       <video src="{{asset('uploads/courses/'.$course->Explanatory_Video)}}" width="200" controls ></video>
                                       @else
                                       <td>no vid</td>
                                       @endif
                                    </td>
                                    <td class="text-center">
                                    <a href="{{route('newcourse.quizes.show',$course->id)}}" class="btn btn-icon btn-light" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('Quizes')}}">
                                            <i data-feather='list'></i>
                                        </a>

                                    <a href="{{route('admin.courses2.showinstructor',$course->id)}}" class="btn btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('instructor')}}">
                                            <i data-feather='list'></i>
                                        </a>

                                    <a href="{{route('admin.courses.chapters',$course->id)}}" class="btn btn-icon btn-dark" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('chapters')}}">
                                            <i data-feather='list'></i>
                                        </a>

                                        <a href="{{route('admin.courses2.lessons',$course->id)}}" class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('learning.lessons')}}">
                                            <i data-feather='list'></i>
                                        </a>
                                        <a href="javascript:;" data-bs-target="#editcourse{{$course->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                            <i data-feather='edit'></i>
                                        </a>

                                            <?php $delete = route('admin.newCourse.delete',['id'=>$course->id]); ?>
                                            <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$course->id}}')">
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

                {{ $courses->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->

@foreach($courses as $course)

    <div class="modal fade text-md-start" id="editcourse{{$course->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.edit')}}: {{$course['name_'.session()->get('Lang')]}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.courses2.update',$course->id), 'id'=>'editcourseForm'.$course->id, 'class'=>'row gy-1 pt-75','files'=>'true'])}}
                    <div class="col-12 col-md-8">
                            <label class="form-label" for="name">{{trans('common.name')}}</label>
                            {{Form::text('name',$course->name,['id'=>'name', 'class'=>'form-control','required'])}}

                        </div>
                        <!-- @if ($active != 'curriculums')
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="section_id">القسم</label>
                                {{Form::select('section_id',sectionsList(),'',['id'=>'section_id', 'class'=>'selectpicker'])}}
                            </div>
                        @endif -->
                        <div class="col-12"></div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="price">{{trans('common.price')}}</label>
                            {{Form::number('price',$course->price,['id'=>'price', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="Discounted_Price">{{trans('بعد الخصم')}}</label>
                            {{Form::number('Discounted_Price',$course->Discounted_Price,['id'=>'Discounted_Price', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="Instructors">{{trans('learning.instructors')}}</label>
                            {{Form::select('Instructors[]',instructorsList(),json_decode($course->Instructors),['id'=>'Instructors', 'class'=>'selectpicker','multiple'=>'true'])}}
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
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="Description"> الوصف</label>
                            {!!Form::textarea('Description',$course->Description,['id'=>'Description', 'class'=>'form-control','rows'=>'3'])!!}
                        </div>
                        <!-- <div class="col-12 col-md-12">
                            <label class="form-label" for="seo_keywords">SEO الكلمات الدليلية</label>
                            {!!Form::textarea('seo_keywords','',['id'=>'seo_keywords', 'class'=>'form-control','rows'=>'3'])!!}
                        </div> -->

                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12">
                                <label class="form-label" for="photo">صورة العرض على الموقع</label>
                                <div>
                                    <img src="{{asset('uploads/courses/'.$course->photo)}}" alt="" width="100">
                                </div>
                                <div class="file-loading">
                                    <input class="files" name="photo" type="file">
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12">
                                <label class="form-label" for="Explanatory_Video">فيديو العرض على الموقع</label>
                                <div>
                                    <video src="{{asset('uploads/courses/'.$course->Explanatory_Video)}}" width="200" controls></video>
                                </div>
                                <div class="file-loading">
                                    <input class="files" name="Explanatory_Video" type="file">
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
<a href="{{route('newcourse.quizes_seperate.show')}}" class="btn btn-primary btn-sm">
            كويز منفصل
        </a>
    @if ($active != 'curriculums')

        <a href="{{route('admin.newCourse.instructors')}}" class="btn btn-primary btn-sm">
            المحاضرين
        </a>
    @endif
    <a href="javascript:;" data-bs-target="#createcourse" data-bs-toggle="modal" class="btn btn-primary btn-sm">
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
                    {{Form::open(['url'=>route('admin.newCourse.store'), 'id'=>'createcourseForm', 'class'=>'row gy-1 pt-75','files'=>'true'])}}


                        <div class="col-12 col-md-8">
                            <label class="form-label" for="name">{{trans('common.name')}}</label>
                            {{Form::text('name','',['id'=>'name', 'class'=>'form-control','required'])}}

                        </div>
                        <!-- @if ($active != 'curriculums')
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="section_id">القسم</label>
                                {{Form::select('section_id',sectionsList(),'',['id'=>'section_id', 'class'=>'selectpicker'])}}
                            </div>
                        @endif -->
                        <div class="col-12"></div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="price">{{trans('common.price')}}</label>
                            {{Form::number('price',0,['id'=>'price', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="Discounted_Price">{{trans('بعد الخصم')}}</label>
                            {{Form::number('Discounted_Price',0,['id'=>'Discounted_Price', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="Instructors">{{trans('learning.instructors')}}</label>
                            {{Form::select('Instructors[]',instructorsList(),'',['id'=>'Instructors', 'class'=>'selectpicker','multiple'])}}
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
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="Description"> الوصف</label>
                            {!!Form::textarea('Description','',['id'=>'Description', 'class'=>'form-control','rows'=>'3'])!!}
                        </div>
                        <!-- <div class="col-12 col-md-12">
                            <label class="form-label" for="seo_keywords">SEO الكلمات الدليلية</label>
                            {!!Form::textarea('seo_keywords','',['id'=>'seo_keywords', 'class'=>'form-control','rows'=>'3'])!!}
                        </div> -->

                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12">
                                <label class="form-label" for="photo">صورة العرض على الموقع</label>
                                <div class="file-loading">
                                    <input class="files" name="photo" type="file">
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12">
                                <label class="form-label" for="Explanatory_Video">فيديو العرض على الموقع</label>
                                <div class="file-loading">
                                    <input class="files" name="Explanatory_Video" type="file">
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
