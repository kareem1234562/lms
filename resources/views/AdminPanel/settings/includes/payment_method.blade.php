<!-- form -->
<div class="row">
    <div class="col-12 col-md-4">
        <label class="form-label" for="click_pay_profile_id">click_pay_profile_id</label>
        {{Form::text('click_pay_profile_id',getSettingValue('click_pay_profile_id'),['id'=>'click_pay_profile_id','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label" for="clickpay_server_key">clickpay_server_key</label>
        {{Form::text('clickpay_server_key',getSettingValue('clickpay_server_key'),['id'=>'clickpay_server_key','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label" for="clickpay_currency">clickpay_currency</label>
        {{Form::text('clickpay_currency',getSettingValue('clickpay_currency'),['id'=>'clickpay_currency','class'=>'form-control'])}}
    </div>
    {{-- <div class="col-12 col-md-4">
        <label class="form-label" for="NOON_PAYMENT_MODE">NOON_PAYMENT_MODE</label>
        {{Form::select('NOON_PAYMENT_MODE',[
          'Test' => 'Test',
          'Live' => 'Live'
        ],getSettingValue('NOON_PAYMENT_MODE'),['id'=>'NOON_PAYMENT_MODE','class'=>'form-control'])}}
    </div> --}}
    {{-- <div class="col-12 col-md-4">
        <label class="form-label" for="from_name">{{trans('common.name')}}</label>
        {{Form::text('from_name',getSettingValue('from_name'),['id'=>'from_name','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label" for="shipping_address_line">{{trans('common.address')}}</label>
        {{Form::text('shipping_address_line',getSettingValue('shipping_address_line'),['id'=>'shipping_address_line','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label" for="shipping_city">{{trans('common.city')}}</label>
        {{Form::text('shipping_city',getSettingValue('shipping_city'),['id'=>'shipping_city','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label" for="shipping_phone">{{trans('common.phone')}}</label>
        {{Form::text('shipping_phone',getSettingValue('shipping_phone'),['id'=>'shipping_phone','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label" for="shipping_country">{{trans('common.country')}}</label>
        {{Form::text('shipping_country',getSettingValue('shipping_country'),['id'=>'shipping_country','class'=>'form-control'])}}
    </div> --}}
    {{-- <div class="divider">
        <div class="divider-text">{{trans('common.freeShipping')}}</div>
    </div>
    <div class="col-12 col-md-2">
        <label class="form-label" for="freeShipping">{{trans('common.freeShipping')}}</label>
        <div class="form-check form-check-success form-switch">
            {{Form::checkbox('freeShipping','1',getSettingValue('freeShipping') == '1' ? true : false,['id'=>'freeShipping', 'class'=>'form-check-input'])}}
            <label class="form-check-label" for="freeShipping"></label>
        </div>
    </div>
    <div class="col-12 col-md-2">
        <label class="form-label" for="freeShippingTimeFrom">{{trans('common.ShippingTimeFrom')}}</label>
        {{Form::text('freeShippingTimeFrom',getSettingValue('freeShippingTimeFrom'),['id'=>'freeShippingTimeFrom', 'class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-2">
        <label class="form-label" for="freeShippingTimeTo">{{trans('common.ShippingTimeTo')}}</label>
        {{Form::text('freeShippingTimeTo',getSettingValue('freeShippingTimeTo'),['id'=>'freeShippingTimeTo', 'class'=>'form-control'])}}
    </div>
    <div class="divider">
        <div class="divider-text">{{trans('common.otherShippingMethod')}}</div>
    </div>
    <div class="col-12 col-md-2">
        <label class="form-label" for="otherShippingMethod">{{trans('common.otherShippingMethod')}}</label>
        <div class="form-check form-check-success form-switch">
            {{Form::checkbox('otherShippingMethod','1',getSettingValue('otherShippingMethod') == '1' ? true : false,['id'=>'otherShippingMethod', 'class'=>'form-check-input'])}}
            <label class="form-check-label" for="otherShippingMethod"></label>
        </div>
    </div>
    <div class="col-12 col-md-2">
        <label class="form-label" for="otherShippingMethodTimeFrom">{{trans('common.ShippingTimeFrom')}}</label>
        {{Form::text('otherShippingMethodTimeFrom',getSettingValue('otherShippingMethodTimeFrom'),['id'=>'otherShippingMethodTimeFrom', 'class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-2">
        <label class="form-label" for="otherShippingMethodTimeTo">{{trans('common.ShippingTimeTo')}}</label>
        {{Form::text('otherShippingMethodTimeTo',getSettingValue('otherShippingMethodTimeTo'),['id'=>'otherShippingMethodTimeTo', 'class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-3">
        <label class="form-label" for="otherShippingMethodFees">{{trans('common.otherShippingMethodFees')}}</label>
        {{Form::number('otherShippingMethodFees',getSettingValue('otherShippingMethodFees'),['id'=>'otherShippingMethodFees','class'=>'form-control'])}}
    </div> --}}
</div>
<!--/ form -->
