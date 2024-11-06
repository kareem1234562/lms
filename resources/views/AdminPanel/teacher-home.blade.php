
<div class="row">

    <div class="col-12">
        <table class="table table-bordered" cellspacing="0" align="center" width="100%">
            <!--<caption>Timetable</caption>-->
            <tr>
                <td height="50" width="100">
                </td>
                @foreach (dayTimes() as $key => $time)
                    <td align="center" height="50"
                        width="100">
                        @if (isset(dayTimes()[$key+1]))
                            <small>{{$time}} - {{dayTimes()[$key+1]}}</small>
                        @else
                            <small>{{$time}} - 22:00</small>
                        @endif
                    </td>
                @endforeach
            </tr>
            @foreach (workingDaysListForTeacher() as $key => $day)
                <tr>
                    <td align="center" height="50">
                        <b>{{$day}}</b>
                    </td>
                    @foreach (dayTimes() as $time)
                        {{-- <?php $the_course = getThisTimeCourse($key,$time); ?>
                        @if ($the_course != '')
                            @if($the_course['colspan'] > 0)
                                <td @if($the_course['colspan'] > 0) colspan="{{$the_course['colspan']}}" @endif height="50" width="100">
                                    <span class="{{$the_course['class']}} w-100">{!!$the_course['course_name']!!}</span>
                                </td>
                            @endif
                        @else --}}
                            <td height="50"width="100">
                                <b>-</b>
                            </td>
                        {{-- @endif --}}
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>

</div>
