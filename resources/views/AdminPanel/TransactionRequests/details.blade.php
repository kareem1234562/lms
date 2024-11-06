@extends('AdminPanel.layouts.master')
@section('content')


<!-- Bordered table start -->
<div class="row" id="table-bordered">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">بيانات المستخدم</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-2">
            <b>الإسم:</b>
            {{$details->user->name ?? '-'}}
          </div>

          <div class="col-4">
            <b>{{trans('common.amount')}}</b>
            {{$details->amount}}
          </div>
          <div class="col-4">
            @if ($details->status != 'confirm')
                <a class="btn btn-sm btn-success" href="{{route('admin.transactionsRequests.confirm',['id'=>$details->id])}}">
                    تنفيذ
                </a>
            @else
                تم قبول الطلب
            @endif
          </div>
        </div>

      </div>

    </div>
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">المرفقات</small>
        </h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            @if ($details->photoLink() != '')
                <img src="{{$details->photoLink()}}" alt="">
            @else
                لا يوجد
            @endif
          </div>
        </div>

      </div>

    </div>
  </div>
</div>
<!-- Bordered table end -->



@stop
