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
                                <th>الرقم الموحد</th>
                                <th class="text-center">الاسم</th>
                                <th class="text-center">الدورات التدريبية</th>
                                <th class="text-center">السعر</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bundles as $bundle)
                                <tr id="row_{{$bundle->id}}">
                                    <td>
                                        # {{$bundle['id']}}
                                    </td>
                                    <td>
                                        {{$bundle['name']}}
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($bundle->items as $item)
                                                <li>
                                                    {{$item->course != '' ? $item->course->name : 'دورة تدريبية محذوفة'}}:
                                                    {{$item->bundle_price}}
                                                    بدلاً من {{$item->original_price}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        {{$bundle->price}}
                                    </td>
                                    <td class="text-center">
                                        <?php $delete = route('admin.courses.bundles.delete',$bundle->id); ?>
                                        <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$bundle->id}}')">
                                            <i data-feather='trash-2'></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="p-3 text-center ">
                                        <h2>{{trans('common.nothingToView')}}</h2>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $bundles->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->

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
                    {{Form::open(['url'=>route('admin.courses.bundles.store'), 'id'=>'createcourseForm', 'class'=>'row gy-1 pt-75'])}}
                        <div class="col-md-4">
                            <label class="form-label" for="name">اسم المجموعة</label>
                            {{Form::text('name','',['id'=>'name', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="from_date">من تاريخ</label>
                            {{Form::date('from_date','',['id'=>'from_date', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="to_date">حتى تاريخ</label>
                            {{Form::date('to_date','',['id'=>'to_date', 'class'=>'form-control','required'])}}
                        </div>
                        @foreach (coursesGet() as $course)
                            <div class="row mt-1">
                                <div class="col-md-6 mt-1">
                                    <p>{{$course->name}}</p>
                                </div>
                                <div class="col-md-3">
                                    <p>{{$course->price}}</p>
                                </div>
                                <div class="col-md-3">
                                    {!! Form::hidden('course_id[]', $course->id) !!}
                                    {{Form::number('course_price[]','',['id'=>'to_date', 'class'=>'form-control','placeholder'=>'السعر بالمجموعة'])}}
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12">
                            <label class="form-label" for="price">السعر الإجمالي</label>
                            {{Form::number('price','',['id'=>'price', 'class'=>'form-control'])}}
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