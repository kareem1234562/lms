<!-- form -->
<div class="row">
    <div class="col-12 col-md-12 mb-2">
        <label class="form-label" for="aboutus_home_title_ar">{{trans('common.name_ar')}}</label>
        {{Form::text('aboutus_home_title_ar',getSettingValue('aboutus_home_title_ar'),['rows'=>'3','id'=>'aboutus_home_title_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12 mb-2">
        <label class="form-label" for="aboutus_home_des_ar">{{trans('common.des_ar')}}</label>
        {{Form::textarea('aboutus_home_des_ar',getSettingValue('aboutus_home_des_ar'),['rows'=>'3','id'=>'aboutus_home_des_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12 mb-2">
        <label class="form-label" for="aboutus_home_title_en">{{trans('common.name_en')}}</label>
        {{Form::text('aboutus_home_title_en',getSettingValue('aboutus_home_title_en'),['rows'=>'3','id'=>'aboutus_home_title_en','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12 mb-2">
        <label class="form-label" for="aboutus_home_des_en">{{trans('common.des_en')}}</label>
        {{Form::textarea('aboutus_home_des_en',getSettingValue('aboutus_home_des_en'),['rows'=>'3','id'=>'aboutus_home_des_en','class'=>'form-control'])}}
    </div>
    {{-- @for ($i = 1; $i <= 4; $i++)
        <div class="col-12 col-md-6 mb-2">
            <label class="form-label" for="aboutus_home_list_{{$i}}">{{trans('learning.aboutus_home_list')}} #{{$i}}</label>
            {{Form::text('aboutus_home_list_'.$i,getSettingValue('aboutus_home_list_'.$i),['rows'=>'3','id'=>'aboutus_home_list_'.$i,'class'=>'form-control'])}}
        </div>
    @endfor --}}
    <div class="col-12"></div>
    <div class="col-md-3 text-center">
        <label class="form-label" for="aboutus_home_photo">
            {{trans('common.photo')}}
        </label>
        {!! getSettingImageValue('aboutus_home_photo') !!}
        <div class="file-loading">
            <input class="files" name="aboutus_home_photo" type="file">
        </div>
    </div>
    {{-- <div class="col-12"></div>
    <div class="divider">
        <div class="divider-text">{{trans('common.salesSettings')}}</div>
    </div>
    <div class="col-12 col-md-3">
        <label class="form-label" for="sales_agent_role_id">{{trans('common.sales_agent_role_id')}}</label>
        {{Form::select('sales_agent_role_id',getRolesList('ar','id'),getSettingValue('sales_agent_role_id'),['id'=>'sales_agent_role_id', 'class'=>'form-select'])}}
    </div> --}}
</div>
<!--/ form -->
