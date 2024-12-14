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
                            @forelse($instructors as $instructor)
                                <tr id="row_{{$instructor->id}}">
                                    <td>
                                        {{$instructor->name}}
                                    </td>
                                    <td class="text-center">
                                        <img src="{{asset('uploads/instructors/'.$instructor->Photo)}}" alt="" width="100">
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:;" data-bs-target="#editcourse_{{$instructor->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                            <i data-feather='edit'></i>
                                        </a>
                                        <?php $delete = route('admin.courses.instructors.delete',['id'=>$instructor->id]); ?>
                                        <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$instructor->id}}')">
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

                {{ $instructors->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->

@foreach($instructors as $instructor)
@if ($errors->hasBag('editcourse_' . $instructor->id) && $errors->getBag('editcourse_' . $instructor->id)->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('editcourse_{{ $instructor->id }}'));
        modal.show();
    });
</script>
@endif
    <div class="modal fade text-md-start" id="editcourse_{{$instructor->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.edit')}}: {{$instructor['name_'.session()->get('Lang')]}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.courses.instructors.update',$instructor->id), 'id'=>'editInstructorForm'.$instructor->id, 'class'=>'row gy-1 pt-75','files'=>'true'])}}
                    <div class="col-12 col-md-3">
                            <label class="form-label" for="name">{{trans('common.name_ar')}}</label>
                            {{Form::text('name',$instructor->name,['id'=>'name', 'class'=>'form-control','required'])}}
                            @if ($errors->hasBag('editcourse_' . $instructor->id) && $errors->getBag('editcourse_' . $instructor->id)->has('name'))
                            <span class="text-danger">{{ $errors->getBag('editcourse_' . $instructor->id)->first('name') }}</span>
                        @endif
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="Specialization"> التخصص</label>
                            {{Form::text('Specialization',$instructor->Specialization,['id'=>'Specialization', 'class'=>'form-control','required'])}}
                            @if ($errors->hasBag('editcourse_' . $instructor->id) && $errors->getBag('editcourse_' . $instructor->id)->has('Specialization'))
                            <span class="text-danger">{{ $errors->getBag('editcourse_' . $instructor->id)->first('Specialization') }}</span>
                        @endif
                        </div>

                        <div class="col-12 col-md-3">
                            <label class="form-label" for="email"> الايميل</label>
                            {{Form::text('email',$instructor->email,['id'=>'email', 'class'=>'form-control','required'])}}
                            @if ($errors->hasBag('editcourse_' . $instructor->id) && $errors->getBag('editcourse_' . $instructor->id)->has('email'))
                            <span class="text-danger">{{ $errors->getBag('editcourse_' . $instructor->id)->first('email') }}</span>
                        @endif
                        </div>
                        <!-- <div class="col-12 col-md-12">
                            <label class="form-label" for="bio_ar">تفاصيل عن المدرب بالعربية</label>
                            {{Form::textarea('bio_ar','',['id'=>'bio_ar', 'class'=>'form-control editor_ar'])}}
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="bio_en">تفاصيل عن المدرب بالإنجليزية</label>
                            {{Form::textarea('bio_en','',['id'=>'bio_en', 'class'=>'form-control editor_ar'])}}
                        </div> -->

                        <div class="col-12"></div>

                        <div class="col-12 col-md-12">
                            <label class="form-label" for="Phone">phone</label>
                            {{Form::text('Phone',$instructor->Phone,['id'=>'Phone', 'class'=>'form-control'])}}
                            @if ($errors->hasBag('editcourse_' . $instructor->id) && $errors->getBag('editcourse_' . $instructor->id)->has('Phone'))
                            <span class="text-danger">{{ $errors->getBag('editcourse_' . $instructor->id)->first('Phone') }}</span>
                        @endif
                        </div>

                        <div class="col-12"></div>

                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12">
                                <label class="form-label" for="Photo">صورة</label>
                                <div>
                                    <img src="{{asset('uploads/instructors/'.$instructor->Photo)}}" alt="" width="100">
                                </div>
                                <div class="file-loading">
                                    <input class="files" name="Photo" type="file">
                                </div>
                                @if ($errors->hasBag('editcourse_' . $instructor->id) && $errors->getBag('editcourse_' . $instructor->id)->has('Photo'))
                            <span class="text-danger">{{ $errors->getBag('editcourse_' . $instructor->id)->first('Photo') }}</span>
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
                    {{Form::open(['url'=>route('admin.courses.instructors.store'), 'id'=>'createcourseForm', 'class'=>'row gy-1 pt-75','files'=>'true'])}}
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="name">{{trans('common.name_ar')}}</label>
                            {{Form::text('name','',['id'=>'name', 'class'=>'form-control','required'])}}
                            @if ($errors->createcourse->has('name'))
                                <span class="text-danger">{{ $errors->createcourse->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="Specialization"> التخصص</label>
                            {{Form::text('Specialization','',['id'=>'Specialization', 'class'=>'form-control','required'])}}
                            @if ($errors->createcourse->has('Specialization'))
                                <span class="text-danger">{{ $errors->createcourse->first('Specialization') }}</span>
                            @endif
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="email"> الايميل</label>
                            {{Form::text('email','',['id'=>'email', 'class'=>'form-control','required'])}}
                            @if ($errors->createcourse->has('email'))
                                <span class="text-danger">{{ $errors->createcourse->first('email') }}</span>
                            @endif
                        </div>
                        <!-- <div class="col-12 col-md-12">
                            <label class="form-label" for="bio_ar">تفاصيل عن المدرب بالعربية</label>
                            {{Form::textarea('bio_ar','',['id'=>'bio_ar', 'class'=>'form-control editor_ar'])}}
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="bio_en">تفاصيل عن المدرب بالإنجليزية</label>
                            {{Form::textarea('bio_en','',['id'=>'bio_en', 'class'=>'form-control editor_ar'])}}
                        </div> -->

                        <div class="col-12"></div>

                        <div class="col-12 col-md-12">
                            <label class="form-label" for="Phone">phone</label>
                            {{Form::text('Phone','',['id'=>'Phone', 'class'=>'form-control'])}}
                            @if ($errors->createcourse->has('Phone'))
                                <span class="text-danger">{{ $errors->createcourse->first('Phone') }}</span>
                            @endif
                        </div>

                        <div class="col-12"></div>

                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12">
                                <label class="form-label" for="Photo">صورة</label>
                                <div class="file-loading">
                                    <input class="files" name="Photo" type="file">
                                </div>
                                @if ($errors->createcourse->has('Photo'))
                                <span class="text-danger">{{ $errors->createcourse->first('Photo') }}</span>
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
    @if ($errors->createcourse->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('createcourse'));
        modal.show();
    });
</script>
@endif
@stop

@section('scripts')
<script src="{{asset('AdminAssets/app-assets/js/scripts/pages/modal-add-course.js')}}"></script>



@stop
