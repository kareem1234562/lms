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
              <th>{{trans('common.user')}}</th>
              <th>{{trans('common.amount')}}</th>
              <th>الحالة</th>
              <th class="text-center">الإجراءات</th>
            </tr>
          </thead>
          <tbody>
            @forelse($orders as $order)
            <tr id="row_{{$order->id}}">
              <td>
                <a href="{{route('admin.orders.details',['id'=>$order->id])}}">
                  <b>{{$order->user->name ?? '-'}}</b>
                </a>
              </td>
              <td>{{$order->amount}}</td>
              <td>{!!$order->requestStatus()!!}</td>
              <td class="text-center">
                @if ($order->status == 'pending')
                    <a class="btn btn-sm btn-success" href="{{route('admin.orders.confirm',['id'=>$order->id])}}">
                        تنفيذ
                    </a>
                    <?php $delete = route('admin.orders.delete',['id'=>$order->id]); ?>
                    <button type="button" class="btn btn-sm btn-danger"
                    onclick="confirmDelete('{{$delete}}','{{$order->id}}')" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
                    حذف
                    </button>
                @else
                    لا يوجد إجراءات مطلوبة
                @endif
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="p-3 text-center ">
                <h2>لا يوجد أي بيانات لعرضها الآن</h2>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
        {{ $orders->links('vendor.pagination.default') }}
      </div>


    </div>
  </div>
</div>
<!-- Bordered table end -->



@stop
