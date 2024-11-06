<!-- form -->
<div class="row">
    <div class="col-12 col-md-4">
        <label class="form-label" for="phone">{{trans('common.phone')}}</label>
        {{Form::text('phone',getSettingValue('phone'),['id'=>'phone','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label" for="mobile">{{trans('common.mobile')}}</label>
        {{Form::text('mobile',getSettingValue('mobile'),['id'=>'mobile','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label" for="email">{{trans('common.email')}}</label>
        {{Form::text('email',getSettingValue('email'),['id'=>'email','class'=>'form-control'])}}
    </div>
    <div class="col-12"></div>
    <div class="divider">
        <div class="divider-text">{{trans('learning.socialLinks')}}</div>
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="facebook">{{trans('learning.facebook')}}</label>
        {{Form::text('facebook',getSettingValue('facebook'),['id'=>'facebook','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="twitter">{{trans('learning.twitter')}}</label>
        {{Form::text('twitter',getSettingValue('twitter'),['id'=>'twitter','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="instagram">{{trans('learning.instagram')}}</label>
        {{Form::text('instagram',getSettingValue('instagram'),['id'=>'instagram','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="linkedin">{{trans('learning.linkedin')}}</label>
        {{Form::text('linkedin',getSettingValue('linkedin'),['id'=>'linkedin','class'=>'form-control'])}}
    </div>
    
    <div class="col-12 mt-2"></div>
    <hr>
    <div class="col-12 col-md-12">
        <label class="form-label" for="address">{{trans('common.address')}}</label>
        {{Form::textarea('address',getSettingValue('address'),['id'=>'address','class'=>'form-control','rows'=>'3'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="map">{{trans('common.map')}}</label>
        {{Form::textarea('map',getSettingValue('map'),['id'=>'map','class'=>'form-control','rows'=>'3'])}}
    </div>
</div>
<!--/ form -->