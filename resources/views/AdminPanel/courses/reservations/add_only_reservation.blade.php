@extends('AdminPanel.layouts.master')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{Form::open(['url'=>route('admin.add_only_reservation.submit'), 'id'=>'createReservationForm', 'class'=>'row gy-1 pt-75','files'=>'true'])}}
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="name">اسم الطالب</label>
                            {{Form::text('name',$client->Name,['id'=>'name', 'class'=>'form-control','disabled'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="cellphone">رقم الهاتف</label>
                            {{Form::text('cellphone',$client->cellphone,['id'=>'cellphone', 'class'=>'form-control','disabled'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="address">العنوان</label>
                            {{Form::text('address',$client->address,['id'=>'address', 'class'=>'form-control','disabled'])}}
                            {!! Form::hidden('client_id', $client->id) !!}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="agent_id">موظف المبيعات</label>
                            {{Form::select('agent_id',['0'=>'غير تابع لموظف']+agentsList(),'',['id'=>'agent_id', 'class'=>'form-control selectpicker','data-live-search'=>'true'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="theType">نوع الحجز</label>
                            {{Form::select('theType',[
                                                    'course' => 'دورة تدريبية',
                                                    'bundle' => 'دورات تدريبية مجمعة'
                                                    ],'',['id'=>'theType', 'class'=>'form-control','onchange'=>'getCoursesOrBundles()','required'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="course_id">الدورة التدريبية</label>
                            {{Form::select('course_id',[''=>'اختر الدورة التدريبية'] + coursesList(),'',['id'=>'course_id', 'class'=>'form-control selectpicker','required'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="attendance">نوع الحضور</label>
                            {{Form::select('attendance',[
                                                    'group' => 'داخل مجموعة',
                                                    'private' => 'خاص',
                                                    'online' => 'أونلاين'
                                                    ],'',['id'=>'attendance', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 text-center mt-2 pt-50">
                            <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@stop


@section('scripts')
    <script type="text/javascript">
        function getCoursesOrBundles() {
            var type = $('#theType').val();
            $.ajax({    //create an ajax request to display.php
                type: "GET",
                url: "<?php echo url('/AdminPanel/getCoursesOrBundles?type='); ?>"+type,             
                dataType: "html",   //expect html to be returned                
                success: function(data){ 
                    var CoursesList = $.parseJSON(data);
                    
                    //populate CoursesList options
                    var CoursesListOption = '';
                    if (type == 'course') {
                        CoursesListOption += '<option value="">اختر الدورة التدريبية</option>';
                    } else {
                        CoursesListOption += '<option value="">اختر مجمموعة الدورات المجمعة</option>';
                    }
                    for (var i=0;i<CoursesList.length;i++){
                        CoursesListOption += '<option value="'+CoursesList[i]['id']+'">'+CoursesList[i]['name']+'</option>';
                    }
                    $('#course_id').find('option').remove().end().append(CoursesListOption).selectpicker('refresh');
                }
            });
        }
    </script>
@stop
