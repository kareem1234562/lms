@extends('FrontEnd.layouts.master')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('قم بتفعيل حسابك') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('تم إرسال رسالة جديدة إلى بريدك الإلكتروني يرجى مراجعة الرسائل المهملة أيضاً أو junk mail.') }}
                        </div>
                    @endif

                    {{ __('لا يمكنك الولوج إلى تلك الصفحة بدون تفعيل حسابك.') }}
                    {{ __('في حالة عدم استقبالك لرسالة التفعيل') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('اضغط هنا للحصول على رسالة أخرى') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
