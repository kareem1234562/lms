@extends('FrontEnd.layouts.master')
@section('content')

<div class="container pt-4">
    <div class="main-body">
        <div class="row">
            @if (session()->get('faild') != '')
                <div class="col-12">
                    <div class="alert alert-danger mb-2 p-3">
                        {{session()->get('faild')}}
                    </div>
                </div>
            @endif
            <div class="col-lg-4">
                @include('user.dashboard.includes.sidebar')
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-title m-0 p-3">
                                <h3 class="m-0 pb-3 border-bottom border-secondary text-primary">
                                    {{trans('common.Purhcases')}}
                                </h3>
                            </div>
                            <div class="card-body">
                                @if ($order != '')

                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">الدورة التدريبية</th>
                                                    <th scope="col">الاسم</th>
                                                    <th scope="col">السعر</th>
                                                    <th scope="col"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($order->items as $key => $item)
                                                        <?php $course = $item->course; ?>
                                                        @if ($course->is_course == '1')
                                                            <?php $link = route('website.courses.details',$course->id); ?>
                                                        @else
                                                            <?php $link = route('website.curriculums.details',$course->id); ?>
                                                        @endif
                                                        <tr>
                                                            <th scope="row">{{$key+1}}</th>
                                                            <td>
                                                                <a href="{{$link}}">
                                                                    <img src="{{$course->photoLink()}}" alt="{{$course->name}}" width="150">
                                                                </a>
                                                            </td>
                                                            <td><h5 class="card-title">{{$course->name}}</h5></td>
                                                            <td><h5 class="card-title">{{$item->price}}</h5></td>
                                                            <td>
                                                                <a href="{{route('user.cart.removeItem',$item->id)}}" class="btn btn-danger">
                                                                    <i class="ri-delete-bin-fill"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        @if ($order->items()->count() == 0)
                                            <div class="col-12">
                                                <div class="alert alert-danger p-3 m-2 text-center">
                                                    لا يوجد لديك أي عناصر في سلة المشتريات
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @if ($order->items != '')
                                        <div class="row">
                                            <div class="col-6 text-start">
                                                <b>الإجمالي:</b> {{$order->total}}
                                            </div>
                                            <div class="col-6 text-end">

                                                <span class="btn btn-success" data-bs-toggle="modal" data-bs-target="#rechargeModal">
                                                    إتمام الدفع
                                                </span>
                                                <div class="modal fade" id="rechargeModal" tabindex="-1" aria-labelledby="rechargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            {!!Form::open(['class'=>'auth-login-form mt-2','url'=>route('user.dashboard.rechargeBalance'),'files'=>'true'])!!}
                                                                <div class="modal-body">
                                                                    <div class="row text-start">
                                                                        <div class="col-sm-6">
                                                                            <label class="form-label">{{trans('common.payment_method')}}</label>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" value="online" name="payment_method" id="online_payment" required>
                                                                                <label class="form-check-label" for="online_payment">
                                                                                    Visa / Master Card
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" value="manual_transfeer" name="payment_method" id="manual_transfeer_payment" required>
                                                                                <label class="form-check-label" for="manual_transfeer_payment">
                                                                                    {{trans('common.manual_transfeer')}}
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <div class="mb-3">
                                                                                <label for="fileInput" class="form-label">صورة إثبات التحويل البنكي</label>
                                                                                <input type="file" name="photo" class="form-control" id="fileInput" accept="image/*">
                                                                            </div>
                                                                            <small  class="form-text text-danger">في حالة اختيار التحويل البنكي فقط</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="default-btn">
                                                                        إتمام الدفع
                                                                    </button>
                                                                </div>
                                                            {{Form::close()}}
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <a href="{{route('user.cart.checkout')}}" class="btn btn-success">
                                                    إتمام الدفع
                                                </a> --}}
                                            </div>
                                        </div>
                                    @endif
                                @else
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="alert alert-danger">
                                                    لا يوجد لديك أي عناصر في سلة المشتريات
                                                </div>
                                            </div>
                                        </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.me-2 {
    margin-right: .5rem!important;
}
</style>

@stop
