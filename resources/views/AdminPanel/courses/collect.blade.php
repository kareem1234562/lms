<div class="modal fade text-md-start" id="createCollectionModal{{$row->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                </div>
                {{Form::open(['files'=>'true','url'=>route('admin.revenues.store'), 'id'=>'createCollectionModal'.$row->id.'Form', 'class'=>'row gy-1 pt-75'])}}
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="Date">{{trans('common.date')}}</label>
                        {{Form::date('Date','',['id'=>'Date', 'class'=>'form-control','required'])}}
                    </div>
                    <div class="col-12 col-md-2">
                        <label class="form-label" for="amount">{{trans('common.amount')}}</label>
                        {{Form::number('amount','',['step'=>'.01','id'=>'amount', 'class'=>'form-control','required'])}}
                    </div>
                    {!! Form::hidden('client_id', $row->client_id) !!}
                    {!! Form::hidden('course_id', $row->course_id) !!}
                    {!! Form::hidden('group_id', $row->group_id) !!}
                    {!! Form::hidden('Type', $row->type) !!}
                    <div class="col-12 col-md-3">
                        <label class="form-label" for="safe_id">{{trans('common.safe')}}</label>
                        {{Form::select('safe_id',safesList(),'',['id'=>'safe_id', 'class'=>'form-select','required'])}}
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="Notes">{{trans('common.details')}}</label>
                        {{Form::textarea('Notes','',['rows'=>'2','id'=>'Notes', 'class'=>'form-control','required'])}}
                    </div>

                    <div class="divider">
                        <div class="divider-text">{{trans('common.files')}}</div>
                    </div>

                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12 text-center">
                            <label class="form-label" for="Attachments">{{trans('common.attachment')}}</label>
                            <div class="file-loading">
                                <input class="files" name="Attachments[]" type="file" multiple>
                            </div>
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
