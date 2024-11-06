<div class="search_curriculuims">

    <div class="search_box">
        <form action="" method="get">
            <div class="form-group">
                <label>{{trans('common.chooseSection')}}</label>
                {!! Form::select('section_id',[''=>trans('common.chooseSection')] + $sections, $section_id, ['class'=>'form-select','id'=>'section_id']) !!}
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
@stop
