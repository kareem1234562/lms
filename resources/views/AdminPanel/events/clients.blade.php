@extends('AdminPanel.layouts.master')
@section('content')
<?php
    $event_id = 'all';
    $course_id = 'all';
    $cellphone = '';
    if (userCan('clients_view')) {
        $employee = 'all';
        if (isset($_GET['employee'])) {
            if ($_GET['employee'] != 'all') {
                $employee = $_GET['employee'];
            }
        }
    } else {
        $employee = auth()->user()->id;
    }
    if (isset($_GET['cellphone'])) {
        if ($_GET['cellphone'] != '') {
            $cellphone = $_GET['cellphone'];
        }
    }
    if (isset($_GET['course_id'])) {
        if ($_GET['course_id'] != '') {
            $course_id = $_GET['course_id'];
        }
    }
    if (isset($_GET['event_id'])) {
        if ($_GET['event_id'] != '') {
            $event_id = $_GET['event_id'];
        }
    }
    $params = [
        'cellphone' => $cellphone,
        'course_id' => $course_id,
        'event_id' => $event_id
    ];
?>


    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{$title}}
                    </h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-2">
                        <thead>
                            <tr>
                                <th>اسم العميل</th>
                                <th>اسم الدورة التدريبية</th>
                                <th>سعر البيع</th>
                                <th>المدفوع</th>
                                <th>المتبقي</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservations as $reservation)
                                <tr class="row_{{$reservation->id}}">
                                    <td>
                                        {{$reservation->client != '' ? $reservation->client->Name : 'عميل محذوف'}}
                                        <br>
                                        <small>
                                            هاتف: {{$reservation->client != '' ? $reservation->client->cellphone : '-'}}
                                        </small>
                                    </td>
                                    <td>
                                        @if ($reservation->course_reservation_type == 'course')
                                            {{$reservation->course != '' ? $reservation->course->name : 'دورة تدريبية محذوفة'}}
                                            <div class="col-12"></div>
                                            @if ($reservation->group_id == 0)
                                                <small>
                                                    لم يتم تعيين مجموعة للطالب حتى الآن
                                                </small>
                                            @endif
                                        @else
                                            {{$reservation->event != '' ? $reservation->event->title : 'ورشة عمل محذوفة'}}
                                        @endif
                                    </td>
                                    <td>
                                        {{$reservation->reservation_price}}
                                    </td>
                                    <td>
                                        {{$reservation->payments()}}
                                    </td>
                                    <td>
                                        {{$reservation->reservation_price - $reservation->payments()}}
                                    </td>
                                    <td class="text-center">
                                        @if (($reservation->reservation_price - $reservation->payments()) > 0)
                                            <a href="javascript:;" data-bs-target="#createCollectionModal{{$reservation->id}}" data-bs-toggle="modal" class="btn btn-sm btn-primary">
                                                تحصيل دفعة مالية
                                            </a>
                                        @endif
                                        
                                        <?php $delete = route('admin.reservations.delete',$reservation->id); ?>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{$delete}}','{{$reservation->id}}')">
                                            حذف
                                        </button>
                                        @if ($reservation->course_reservation_type == 'course')
                                            <div class="col-12"></div>
                                            <a href="javascript:;" data-bs-target="#changeGroupModal{{$reservation->id}}" data-bs-toggle="modal" class="btn btn-sm btn-info mt-1">
                                                تغيير المجموعة
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-3 text-center ">
                                        <h2>{{trans('common.nothingToView')}}</h2>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $reservations->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->


    @foreach($reservations as $reservation)
        @include('AdminPanel.courses.collect',['client_row'=>$reservation,'type'=>$reservation->course_reservation_type])
        @include('AdminPanel.courses.changeGroup',['client_row'=>$reservation])
    @endforeach


@stop

@section('page_buttons')
    <a href="javascript:;" data-bs-target="#searchClients" data-bs-toggle="modal" class="btn btn-primary btn-sm">
        {{trans('common.search')}}
    </a>

    <div class="modal fade text-md-start" id="searchClients" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    {{Form::open(['id'=>'searchClientsForm', 'class'=>'row gy-1 pt-75', 'method'=>'GET'])}}
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="cellphone">هاتف العميل</label>
                            {{Form::text('cellphone', isset($_GET['cellphone']) ? $_GET['cellphone'] : '',['id'=>'cellphone', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="event_id">ورشة عمل</label>
                            {{Form::select('event_id',['all'=>'بدون تحديد'] + eventsList(), isset($_GET['event_id']) ? $_GET['event_id'] : '',['id'=>'event_id', 'class'=>'selectpicker'])}}
                        </div>
                        <div class="col-12 text-center mt-2 pt-50">
                            <button type="submit" class="btn btn-primary me-1">{{trans('common.search')}}</button>
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