<!-- form -->
<div class="row">
    <div class="col-12 col-md-12 mb-2">
        <label class="form-label" for="website_title">{{trans('learning.website_title')}}</label>
        {{Form::text('website_title',getSettingValue('website_title'),['rows'=>'3','id'=>'website_title','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12 mb-2">
        <label class="form-label" for="new_setting">{{trans('learning.new_setting')}}</label>
        {{Form::text('new_setting',getSettingValue('new_setting'),['rows'=>'3','id'=>'new_setting','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12 mb-2">
        <label class="form-label" for="website_description">{{trans('learning.website_description')}}</label>
        {{Form::text('website_description',getSettingValue('website_description'),['rows'=>'3','id'=>'website_description','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12 mb-2">
        <label class="form-label" for="website_keywords">{{trans('learning.website_keywords')}}</label>
        {{Form::textarea('website_keywords',getSettingValue('website_keywords'),['rows'=>'3','id'=>'website_keywords','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12 mb-2">
        <label class="form-label" for="website_header_codes">{{trans('learning.website_header_codes')}}</label>
        {{Form::textarea('website_header_codes',getSettingValue('website_header_codes'),['rows'=>'3','id'=>'website_header_codes','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12 mb-2">
        <label class="form-label" for="website_footer_codes">{{trans('learning.website_footer_codes')}}</label>
        {{Form::textarea('website_footer_codes',getSettingValue('website_footer_codes'),['rows'=>'3','id'=>'website_footer_codes','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12 mb-2">
        <label class="form-label" for="footer_word_ar">كلمة أسفل الموقع بالعربية</label>
        {{Form::textarea('footer_word_ar',getSettingValue('footer_word_ar'),['rows'=>'3','id'=>'footer_word_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12 mb-2">
        <label class="form-label" for="footer_word_en">كلمة أسفل الموقع بالإنجليزية</label>
        {{Form::textarea('footer_word_en',getSettingValue('footer_word_en'),['rows'=>'3','id'=>'footer_word_en','class'=>'form-control'])}}
    </div>
    <div class="col-md-3 text-center">
        <label class="form-label" for="logo">
            {{trans('common.logo')}}
        </label>
        {!! getSettingImageValue('logo') !!}
        <div class="file-loading">
            <input class="files" name="logo" type="file">
        </div>
    </div>
    <div class="col-md-3 text-center">
        <label class="form-label" for="logo_light">
            {{trans('common.logo_light')}}
        </label>
        {!! getSettingImageValue('logo_light') !!}
        <div class="file-loading">
            <input class="files" name="logo_light" type="file">
        </div>
    </div>
    <div class="col-md-3 text-center">
        <label class="form-label" for="fav">
            {{trans('common.fav')}}
        </label>
        {!! getSettingImageValue('fav') !!}
        <div class="file-loading">
            <input class="files" name="fav" type="file">
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
