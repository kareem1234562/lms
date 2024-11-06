{{-- <?php
    //$today_followups = App\Models\ClientFollowUps::where('UID',auth()->user()->id)->where('status','pinding')->where('contactingDateTime',date('Y-m-d'))->get();
?>
<li class="nav-item dropdown dropdown-notification me-25">
    <a class="nav-link" href="#" data-bs-toggle="dropdown">
        <i class="ficon" data-feather="bell"></i>
        <span class="badge rounded-pill bg-danger badge-up">
            {{count($today_followups) > 99 ? '+99' : count($today_followups)}}
        </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
        <li class="dropdown-menu-header">
            <div class="dropdown-header d-flex">
                <h4 class="notification-title mb-0 me-auto">{{trans('common.Notifications')}}</h4>
                @if(count($today_followups) > 0)
                    <div class="badge rounded-pill badge-light-primary">{{count($today_followups)}} {{trans('common.New')}}</div>
                @endif
            </div>
        </li>
        <li class="scrollable-container media-list">
            @if(count($today_followups) > 0)
                @foreach($today_followups as $followup)
                    <a class="d-flex" href="{{route('admin.followups',['client_id'=>$followup->ClientID])}}">
                        <div class="list-item d-flex align-items-start">
                            <div class="list-item-body flex-grow-1">
                                <p class="media-heading">
                                    {!! $followup->client != '' ? $followup->client->Name : '' !!}
                                </p>
                                <small class="notification-text">{!!$followup->contactingDateTime!!} - {!!$followup->nextContactingTime!!}</small>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <div class="p-1 text-center">
                    <b>{{trans('common.nothingToView')}}</b>
                </div>
            @endif
        </li>
        <li class="dropdown-menu-footer">
            <a class="btn btn-primary w-100" href="{{route('admin.nextFollowups')}}">{{trans('common.Read all notifications')}}</a>
        </li>
    </ul>
</li> --}}
