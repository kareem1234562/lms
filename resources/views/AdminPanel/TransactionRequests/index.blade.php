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
            @forelse($requests as $request)
            <tr id="row_{{$request->id}}">
              <td>
                <a href="{{route('admin.transactionsRequests.details',['id'=>$request->id])}}">
                  <b>{{$request->user->name ?? '-'}}</b>
                </a>
              </td>
              <td>{{$request->amount}}</td>
              <td>{!!$request->requestStatus()!!}</td>
              <td class="text-center">
                @if ($request->status != 'confirm')
                    <a class="btn btn-sm btn-success" href="{{route('admin.transactionsRequests.confirm',['id'=>$request->id])}}">
                        تنفيذ
                    </a>
                    <?php $delete = route('admin.transactionsRequests.delete',['id'=>$request->id]); ?>
                    <button type="button" class="btn btn-sm btn-danger"
                    onclick="confirmDelete('{{$delete}}','{{$request->id}}')" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
                    حذف
                    </button>
                @else
                    تم قبول الطلب
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
        {{ $requests->links('vendor.pagination.default') }}
      </div>


    </div>
  </div>
</div>
<!-- Bordered table end -->



@stop
