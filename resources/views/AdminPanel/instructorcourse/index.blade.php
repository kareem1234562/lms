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
                                <th>{{trans('common.name')}}</th>
                                <th class="text-center">الصورة</th>
                         
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($instructors as $instructor)
                                <tr id="row_{{$instructor->id}}">
                                    <td>
                                        {{$instructor->name}}
                                    </td>
                                    <td class="text-center">
                                        <img src="{{asset('uploads/instructors/'.$instructor->Photo)}}" alt="" width="100">
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-3 text-center ">
                                        <h2>{{trans('common.nothingToView')}}</h2>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $instructors->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->



@stop



@section('scripts')
<script src="{{asset('AdminAssets/app-assets/js/scripts/pages/modal-add-course.js')}}"></script>

@stop
