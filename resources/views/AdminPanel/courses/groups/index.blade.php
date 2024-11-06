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
                                <th class="text-center">البداية / النهاية</th>
                                <th class="text-center">مواعيد المجموعة</th>
                                <th class="text-center">عدد الطلاب</th>
                                <th class="text-center">إجمالي إيراد</th>
                                <th class="text-center">إجمالي تحصيل</th>
                                <th class="text-center">المتبقى</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($groups as $group)
                                <tr id="row_{{$group->id}}">
                                    <td>
                                        # {{$group['id']}}
                                    </td>
                                    <td>
                                        {{$group['start_date']}}
                                        <br>
                                        {{$group['estimated_end_date']}}
                                    </td>
                                    <td>
                                        @if ($group->times()->count() > 0)
                                            @foreach ($group->times as $key => $time)
                                                {{workingDaysList()[$time['day']]}}: من {{$time['time_from']}} إلى {{$time['time_to']}}
                                                @if ($key < ($group->times()->count() - 1))
                                                    <br>
                                                @endif
                                            @endforeach
                                        @else
                                            لم يتم تحديد مواعيد بعد
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{$group->clients()->count()}}
                                    </td>
                                    <td class="text-center">
                                        {{$group->totals()['expected_total_revenue']}}
                                    </td>
                                    <td class="text-center">
                                        {{$group->totals()['collected_revenue']}}
                                    </td>
                                    <td class="text-center">
                                        {{$group->totals()['rest_revenue']}}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('admin.courses.groups.clients',['id'=>$course->id,'group_id'=>$group->id])}}" class="btn btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="طلاب المجموعة">
                                            <i data-feather='list'></i>
                                        </a>
                                        <a href="javascript:;" data-bs-target="#editgroup{{$group->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                            <i data-feather='edit'></i>
                                        </a>
                                        @if($group->canDelete())
                                            <?php $delete = route('admin.courses.groups.delete',['id'=>$course->id,'group_id'=>$group->id]); ?>
                                            <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$group->id}}')">
                                                <i data-feather='trash-2'></i>
                                            </button>
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

                {{ $groups->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->

@foreach($groups as $group)

    <div class="modal fade text-md-start" id="editgroup{{$group->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.edit')}}: {{$group['name_'.session()->get('Lang')]}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.courses.groups.update',['id'=>$course->id,'group_id'=>$group->id]), 'id'=>'editgroupForm'.$group->id, 'class'=>'row gy-1 pt-75'])}}
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="start_date">بداية المجموعة</label>
                            {{Form::date('start_date',$group->start_date,['id'=>'start_date', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="status">حالة المجموعة</label>
                            {{Form::select('status',[
                                '0' => 'في الإنتظار',
                                '1' => 'جاري العمل',
                                '2' => 'تم الإنتهاء'
                            ],$group->status,['id'=>'status', 'class'=>'form-control'])}}
                        </div>
                        <div class="row pt-1">
                            <div class="col-12">
                                <div class="divider">
                                    <div class="divider-text">مواعيد المجموعة</div>
                                </div>
                            </div>
                            <div class="repeatableGroupTimes col-sm-12">
                                @if ($group->times()->count() > 0)
                                    @foreach ($group->times as $key => $time)
                                        <div class="row mb-1 More">
                                            <div class="col-12 col-sm-3">
                                                <label class="form-label" for="day">اليوم</label>
                                                {{Form::select('day[]',workingDaysList(),$time->day,['id'=>'day','class'=>'form-select','required'])}}
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <label class="form-label" for="time_from">من الساعة</label>
                                                {{Form::time('time_from[]',$time->time_from,['id'=>'time_from', 'onkeyup'=>'calculateTotal()', 'class'=>'form-control','required'])}}
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="form-label" for="time_to">إلى الساعة</label>
                                                {{Form::time('time_to[]',$time->time_to,['id'=>'time_to', 'class'=>'form-control','required'])}}
                                            </div>
                                            <div class="col-1 col-md-2 mt-2">
                                                <span class="delete btn btn-icon btn-danger btn-block">
                                                    {{trans('common.delete')}}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-12 mt-2">
                                <span class="add_GroupTimes btn btn-sm btn-info">مواعيد إضافية</span>
                            </div>
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

@endforeach

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
                    {{Form::open(['url'=>route('admin.courses.groups.store',$course->id), 'id'=>'createcourseForm', 'class'=>'row gy-1 pt-75'])}}
                        <div class="col-md-12">
                            <label class="form-label" for="start_date">بداية المجموعة</label>
                            {{Form::date('start_date','',['id'=>'start_date', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="row pt-1">
                            <div class="col-12">
                                <div class="divider">
                                    <div class="divider-text">مواعيد المجموعة</div>
                                </div>
                            </div>
                            <div class="repeatableGroupTimes col-sm-12">
                                <div class="row mb-1">
                                    <div class="col-12 col-sm-3">
                                        <label class="form-label" for="day">اليوم</label>
                                        {{Form::select('day[]',workingDaysList(),'',['id'=>'day','class'=>'form-select','required'])}}
                                    </div>

                                    <div class="col-12 col-md-3">
                                        <label class="form-label" for="time_from">من الساعة</label>
                                        {{Form::time('time_from[]','',['id'=>'time_from', 'onkeyup'=>'calculateTotal()', 'class'=>'form-control','required'])}}
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="form-label" for="time_to">إلى الساعة</label>
                                        {{Form::time('time_to[]','',['id'=>'time_to', 'class'=>'form-control','required'])}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <span class="add_GroupTimes btn btn-sm btn-info">مواعيد إضافية</span>
                            </div>
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
    <script type="text/template" id="RepeatGroupTimesTPL">
        <div class="More row mb-1">
            <div class="col-12 col-sm-3">
                <label class="form-label" for="day">اليوم</label>
                {{Form::select('day[]',workingDaysList(),'',['id'=>'day','class'=>'form-select','required'])}}
            </div>

            <div class="col-12 col-md-3">
                <label class="form-label" for="time_from">من الساعة</label>
                {{Form::time('time_from[]','',['id'=>'time_from', 'onkeyup'=>'calculateTotal()', 'class'=>'form-control','required'])}}
            </div>
            <div class="col-12 col-md-3">
                <label class="form-label" for="time_to">إلى الساعة</label>
                {{Form::time('time_to[]','',['id'=>'time_to', 'class'=>'form-control','required'])}}
            </div>
            <div class="col-1 col-md-2 mt-2">
                <span class="delete btn btn-icon btn-danger btn-block">
                    {{trans('common.delete')}}
                </span>
            </div>
        </div>
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            var max_fields              = 50;
            var GroupTimes_wrapper   = $(".repeatableGroupTimes");
            var add_GroupTimes       = $(".add_GroupTimes");
            var RepeatGroupTimesTPL  = $("#RepeatGroupTimesTPL").html();


            var x = 1;
            $(add_GroupTimes).click(function(e){
                e.preventDefault();
                if(x < max_fields){
                    x++;
                    $(GroupTimes_wrapper).append(RepeatGroupTimesTPL); //add input box
                }else{
                    alert('You Reached the limits')
                }
            });

            $(GroupTimes_wrapper).on("click",".delete", function(e){
                e.preventDefault(); $(this).closest('.More').remove(); x--;
            });


        });
    </script>
@stop
