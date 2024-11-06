<div class="search_curriculuims">

    <div class="search_box">
        <form action="" method="get">
            <div class="form-group">
                <label>{{trans('common.selectCountry')}}</label>
                {!! Form::select('country_id',[''=>trans('common.selectCountry')] + $countries, $country_id, ['class'=>'form-select','id'=>'country_id', 'onchange'=>'changeUniversityList(this)']) !!}
            </div>
            <div class="form-group">
                <label>{{trans('common.selectUniversity')}}</label>
                {!! Form::select('university_id',[''=>trans('common.selectUniversity')] + $Univerisities, $university_id, ['class'=>'form-select','id'=>'university_id', 'onchange'=>'changeCollegesList(this)']) !!}
            </div>
            <div class="form-group">
                <label>{{trans('common.selectCollege')}}</label>
                {!! Form::select('college_id',[''=>trans('common.selectCollege')] + $Colleges, $college_id, ['class'=>'form-select','id'=>'college_id']) !!}
            </div>
            <div class="form-group">
                <div class="search-inp">
                    <button type="submit">
                        <i class="ri-search-line"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



@section('scripts')
<style>
            .search_curriculuims .search_box {
                width: 100%;
                text-align: center;
                padding: 30px 0px;
            }
            .search_curriculuims .search_box .form-group {
                display: inline-block;
                background-color: #fff;
                padding: 15px;
                margin-right: -4px;
                width: 210px;
                text-align: start;
                vertical-align: top;
                border-left: solid 1px #ccc;
            }
            .search_curriculuims .search_box .form-group:first-child {
                border-top-right-radius: 50px;
                border-bottom-right-radius: 50px;
            }
            .search_curriculuims .search_box .form-group:last-child {
                border-top-left-radius: 50px;
                border-bottom-left-radius: 50px;
                width: auto;
                padding: 0px;
            }
            .search_curriculuims .search_box label {
                display: block;
                padding: 5px 10px 0px 10px;
                margin-bottom: 0px;
                color: #b1b1b1;
            }
            .search_curriculuims .search_box select {
                width: 100%;
                font-size: 12px;
                border: none;
                padding: 5px 10px 5px 30px;
                background-position: 0.75rem center;
            }
            .search_curriculuims .search_box select:focus {
                border: none;
                box-shadow: none;
            }
            .search_curriculuims .search_box .search-inp {

            }
            .search_curriculuims .search_box .search-inp button {
                background: #cbc01b;
                color: #fff;
                border: none;
                padding: 30px;
                border-radius: 50px 0px 0px 50px;
            }
            .ri-search-line {
                font-size: 23px;
            }

</style>
<script>
    function changeUniversityList(elem) {
        $.ajax({    //create an ajax request to display.php
            type: "GET",
            url: "<?php echo url('/ajax/GetUniversityList?get=University&id="+elem.value+"'); ?>",
            dataType: "html",   //expect html to be returned
            success: function(data){
                var UniversityList = $.parseJSON(data);

                //populate UniversityList options
                var UniversityListOption = '';
                UniversityListOption += '<option value="">{{trans("common.selectUniversity")}}</option>';
                for (var i=0;i<UniversityList.length;i++){
                    UniversityListOption += '<option value="'+UniversityList[i]['id']+'">'+UniversityList[i]['name']+'</option>';
                }
                $("select#university_id").find('option').remove().end().append(UniversityListOption);
                $("select#college_id").find('option').remove().end().append('<option value="">{{trans("common.selectCollege")}}</option>');
            }
        });
    }
    function changeCollegesList(elem) {
        $.ajax({    //create an ajax request to display.php
            type: "GET",
            url: "<?php echo url('/ajax/GetUniversityList?get=Specialization&id="+elem.value+"'); ?>",
            dataType: "html",   //expect html to be returned
            success: function(data){
                var SpecializationList = $.parseJSON(data);

                //populate SpecializationList options
                var SpecializationListOption = '';
                SpecializationListOption += '<option value="">{{trans("common.selectCollege")}}</option>';
                for (var i=0;i<SpecializationList.length;i++){
                    SpecializationListOption += '<option value="'+SpecializationList[i]['id']+'">'+SpecializationList[i]['name']+'</option>';
                }
                $("select#college_id").find('option').remove().end().append(SpecializationListOption);
            }
        });
    }

</script>
@stop
