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
                                <th class="text-center">سعر الكورس</th>
                                <th class="text-center">المدفوع</th>
                                <th class="text-center">المتبقى</th>
                                <th class="text-center">أيام الحضور</th>
                                <th class="text-center">الغياب</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservations as $reservation)
                                <tr id="row_{{$reservation->id}}">
                                    <td>
                                        # {{$reservation['id']}}
                                    </td>
                                    <td>
                                        {{$reservation->client->Name}}
                                    </td>
                                    <td>
                                        {{$reservation->reservation_price}}
                                    </td>
                                    <td class="text-center">
                                        {{$reservation->totals()['collected_revenue']}}
                                    </td>
                                    <td class="text-center">
                                        {{$reservation->totals()['rest_revenue']}}
                                    </td>
                                    <td class="text-center">
                                        -
                                    </td>
                                    <td class="text-center">
                                        -
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:;" data-bs-target="#changeGroupModal{{$reservation->id}}" data-bs-toggle="modal" class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="نقل لمجموعة أخرى">
                                            <i data-feather='edit'></i>
                                        </a>
                                        @if ($reservation->totals()['rest_revenue'] > 0)
                                            <a href="javascript:;" data-bs-target="#createCollectionModal{{$reservation->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="تحصيل أموال">
                                                <i data-feather='dollar-sign'></i>
                                            </a>
                                        @else
                                            <span class="btn btn-icon btn-default">خالص</span>
                                        @endif
                                        <div class="col-12"></div>
                                        @if ($reservation->status != 'done')
                                            <a href="javascript:;" data-bs-target="#uploadCertificate{{$reservation->id}}" data-bs-toggle="modal" class="btn btn-sm btn-success mt-1">
                                                رفع الشهادة
                                            </a>
                                        @else
                                            <a href="{{route('admin.clients.activateCertificate',$reservation->id)}}" class="btn btn-sm btn-warning mt-1">
                                                تعطيل الشهادة
                                            </a>
                                        @endif
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



            </div>
        </div>
    </div>
    <!-- Bordered table end -->

@foreach($reservations as $reservation)

    @include('AdminPanel.courses.changeGroup',['row'=>$reservation])

    @include('AdminPanel.courses.uploadCertificate',['row'=>$reservation])
    @if ($reservation->totals()['rest_revenue'] > 0)
        @include('AdminPanel.courses.collect',['row'=>$reservation])
    @endif

@endforeach

@stop

@section('page_buttons')
    <a href="javascript:;" data-bs-target="#createcourse" data-bs-toggle="modal" class="btn btn-primary">
        {{trans('common.CreateNew')}}
    </a>

    <div class="modal fade text-md-start" id="createcourse" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.courses.groups.clients.store',['id'=>$course->id,'group_id'=>$group->id]), 'id'=>'createcourseForm', 'class'=>'row gy-1 pt-75'])}}
                        <div class="col-md-12">
                            <label class="form-label" for="clients">الطلاب الغير موزعين على مجموعات</label>
                            {{Form::select('clients[]',unsignedClientsForGroups($course->id),'',['id'=>'clients', 'class'=>'form-control selectpicker','multiple','required'])}}
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
