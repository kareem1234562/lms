@extends('FrontEnd.layouts.master')
@section('content')


        <!-- Inner Banner -->
        <div class="inner-banner inner-banner-bg12">
            <div class="container">
                <div class="inner-title text-center">
                    <h3>ارسل بياناتك الآن</h3>
                    <ul>
                        <li>
                            <a href="{{url('/')}}">الرئيسية</a>
                        </li>
                        <li>
                            {{$title}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Inner Banner End -->

        <!-- Contact Widget Area -->
        <div class="contact-widget-area pb-70">
            <div class="container">
                <div class="section-title text-center mt-3 mb-45">
                    <span>{{$title}}</span>
                    <h2>ارسل بياناتك الآن</h2>
                </div>
                <div class="contact-form">
                    @if (session()->get('success') != '')
                        <div class="alert alert-success">
                            {!!session()->get('success')!!}
                        </div>
                    @endif
                    {!! Form::open(['id'=>'bookForm']) !!}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" required data-error="برجاء إدخال الاسم الثلاثي" placeholder="الاسم الثلاثي">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" required data-error="برجاء إدخال بريدك الإلكتروني صحيحاً" placeholder="البريد الإلكتروني">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    {!!Form::select('country',[
                                        '1' => 'مصر',
                                        '2' => 'السعودية'
                                        ],'',['class'=>'form-control'])!!}
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="text" name="phone_number" id="phone_number" required data-error="برجاء إدخال رقم الهاتف" class="form-control" placeholder="رقم الهاتف">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="text" name="address" id="address" required data-error="برجاء إدخال العنوان" class="form-control" placeholder="العنوان">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="default-btn">
                                    احجز الآن
                                </button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- Contact Widget Area End -->



@stop

@section('scripts')
    <script>
        $("#bookForm").validator().on("submit", function (event) {
            if (event.isDefaultPrevented()) {
                // handle the invalid form...
                formError();
                submitMSG(false, "هل قمت بتسجيل كافة البيانات؟");
            } else {
                // everything looks good!
                event.preventDefault();
                submitBookForm();
            }
        });
        function submitBookForm(){
            // Initiate Variables With Form Content
            var name = $("#name").val();
            var email = $("#email").val();
            var msg_subject = $("#msg_subject").val();
            var phone_number = $("#phone_number").val();
            var message = $("#message").val();


            $.ajax({
                type: "POST",
                url: "{{route('website.book.submit',['id'=>$id,'type'=>$type])}}",
                data: "_token": "{{ csrf_token() }}","name=" + name + "&email=" + email + "&msg_subject=" + msg_subject + "&phone_number=" + phone_number + "&message=" + message,
                success : function(text){
                    if (text == "success"){
                        formSuccess();
                    } else {
                        formError();
                        submitMSG(false,text);
                    }
                }
            });
        }

    </script>
@endsection