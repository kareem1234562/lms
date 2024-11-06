<div class="modal fade text-md-start" id="changeGroupModal{{$row->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                {{Form::open(['files'=>'true','url'=>route('admin.clients.changeGroup',$row->id), 'id'=>'changeGroupModal'.$row->id.'Form', 'class'=>'row gy-1 pt-75'])}}
                    <div class="col-12">
                        <label class="form-label" for="group_id">
                            اختر المجموعة
                        </label>
                        {{Form::select('group_id',['0'=>'إزالة من كافة المجموعات'] + availableGroupsList($row->course_id),$row->group_id,['id'=>'group_id', 'class'=>'form-select','required'])}}
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
