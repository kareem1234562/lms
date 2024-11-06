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
                                <th>{{trans('common.title')}}</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($CoinsQs as $CoinsQ)
                            <tr id="row_{{$CoinsQ->id}}">
                                <td>
                                    {{$CoinsQ['name_ar']}}<br>
                                    {{$CoinsQ['name_en']}}
                                </td>
                                <td class="text-center">
                                    <a href="javascript:;" data-bs-target="#editCoinsQ{{$CoinsQ->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <?php $delete = route('admin.coins_questions.delete',['id'=>$CoinsQ->id]); ?>
                                    <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$CoinsQ->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
                                        <i data-feather='trash-2'></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-3 text-center ">
                                        <h2>{{trans('common.nothingToView')}}</h2>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @foreach($CoinsQs as $CoinsQ)
                    <div class="modal fade text-md-start" id="editCoinsQ{{$CoinsQ->id}}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">{{trans('common.edit')}}</h1>
                                    </div>
                                    {{Form::open(['url'=>route('admin.coins_questions.update',['id'=>$CoinsQ->id]), 'id'=>'editCoinsQForm', 'class'=>'row gy-1 pt-75'])}}
                                        <div class="col-12 col-md-12">
                                            <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                                            {{Form::text('name_ar',$CoinsQ->name_ar,['id'=>'name_ar', 'class'=>'form-control'])}}
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                                            {{Form::text('name_en',$CoinsQ->name_en,['id'=>'name_en', 'class'=>'form-control'])}}
                                        </div>
                                        @for ($x=1;$x<=4;$x++)
                                            <div class="col-12 col-md-6">
                                                <label class="form-label" for="answer{{$x}}_ar">{{trans('learning.answerAr',['no'=>$x])}}</label>
                                                {{Form::text('answer'.$x.'_ar',$CoinsQ['answer'.$x.'_ar'],['id'=>'answer'.$x.'_ar', 'class'=>'form-control'])}}
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="form-label" for="answer{{$x}}_en">{{trans('learning.answerEn',['no'=>$x])}}</label>
                                                {{Form::text('answer'.$x.'_en',$CoinsQ['answer'.$x.'_en'],['id'=>'answer'.$x.'_en', 'class'=>'form-control'])}}
                                            </div>
                                        @endfor
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="true_answer">{{trans('learning.true_answer')}}</label>
                                            {{Form::select('true_answer',[
                                                                            1 => 1,
                                                                            2 => 2,
                                                                            3 => 3,
                                                                            4 => 4
                                                                        ],$CoinsQ->true_answer,['id'=>'true_answer', 'class'=>'form-select'])}}
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="coins">{{trans('learning.coins')}}</label>
                                            {{Form::number('coins',$CoinsQ->coins,['id'=>'coins', 'class'=>'form-control'])}}
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

                {{ $CoinsQs->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->



@stop

@section('page_buttons')
    <a href="javascript:;" data-bs-target="#createCoinsQ" data-bs-toggle="modal" class="btn btn-primary">
        {{trans('common.CreateNew')}}
    </a>

    <div class="modal fade text-md-start" id="createCoinsQ" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.coins_questions.store'), 'id'=>'createCoinsQForm', 'class'=>'row gy-1 pt-75'])}}
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                            {{Form::text('name_ar','',['id'=>'name_ar', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                            {{Form::text('name_en','',['id'=>'name_en', 'class'=>'form-control'])}}
                        </div>
                        @for ($x=1;$x<=4;$x++)
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="answer{{$x}}_ar">{{trans('learning.answerAr',['no'=>$x])}}</label>
                                {{Form::text('answer'.$x.'_ar','',['id'=>'answer'.$x.'_ar', 'class'=>'form-control'])}}
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="answer{{$x}}_en">{{trans('learning.answerEn',['no'=>$x])}}</label>
                                {{Form::text('answer'.$x.'_en','',['id'=>'answer'.$x.'_en', 'class'=>'form-control'])}}
                            </div>
                        @endfor
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="true_answer">{{trans('learning.true_answer')}}</label>
                            {{Form::select('true_answer',[
                                                            1 => 1,
                                                            2 => 2,
                                                            3 => 3,
                                                            4 => 4
                                                        ],'',['id'=>'true_answer', 'class'=>'form-select'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="coins">{{trans('learning.coins')}}</label>
                            {{Form::number('coins',1,['id'=>'coins', 'class'=>'form-control'])}}
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
