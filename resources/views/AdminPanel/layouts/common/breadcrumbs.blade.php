    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-start mb-0">{{$title}}</h2>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
               
                    @if(isset($breadcrumbs))
                        @foreach($breadcrumbs as $item)
                            @if($item['url'] != '')
                                <li class="breadcrumb-item">
                                    <a href="{{$item['url']}}">{{$item['text']}}</a>
                                </li>
                            @else
                                <li class="breadcrumb-item active">
                                    {{$item['text']}}
                                </li>
                            @endif
                        @endforeach
                    @endif
                </ol>
            </div>
        </div>
    </div>
