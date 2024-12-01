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

                                <th class="text-center">الصوره</th>

                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($quizes as $quize)
                                <tr id="row_{{$quize->id}}">
                                    <td>
                                        {{$quize->name}}
                                    </td>

                                    <td class="text-center">
                                        <img src="{{asset('uploads/quizseperate/icons/'.$quize->icon)}}" alt="no" width="100" height="100" style="border-radius: 100%;" >
                                    </td>

                                    <td class="text-center">

                                    <a href="{{route('newcourse.question_seperate.show',$quize->id)}}" class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('Question')}}">
                                            <i data-feather='list'></i>
                                        </a>


                                        <a href="javascript:;" data-bs-target="#editchapter{{$quize->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                            <i data-feather='edit'></i>
                                        </a>


                                            <?php $delete = route('newcourse.quizes_seperate.delete',['id'=>$quize->id]); ?>
                                            <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$quize->id}}')">
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

                {{ $quizes->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->

@foreach($quizes as $quize)

    <div class="modal fade text-md-start" id="editchapter{{$quize->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.edit')}}: {{$quize['name_'.session()->get('Lang')]}}</h1>
                    </div>
                    {{Form::open(['url'=>route('newcourse.quizes_seperate.update',$quize->id), 'id'=>'editchapterForm'.$quize->id, 'class'=>'row gy-1 pt-75','files'=>'true'])}}
                    <div class="col-12 col-md-8">
                    <label class="form-label" for="name">{{trans('common.name')}}</label>
                    {{Form::text('name',$quize->name,['id'=>'name', 'class'=>'form-control','required'])}}
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
                        <img src="{{asset('uploads/quizseperate/icons/'.$quize->icon)}}" alt="no" width="100" style="border-radius: 100%;">
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
                    {{Form::open(['url'=>route('newcourse.quizes_seperate.store'), 'id'=>'createcourseForm', 'class'=>'row gy-1 pt-75','files'=>'true'])}}



                <div class="col-12 col-md-8">
                    <label class="form-label" for="name">{{trans('common.name')}}</label>
                    {{Form::text('name','',['id'=>'name', 'class'=>'form-control','required'])}}
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
@stop
