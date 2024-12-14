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

                                <th class="text-center">السوال</th>
                                <th class="text-center">الاجابه الاولى</th>
                                <th class="text-center">الاجابه الثانيه</th>
                                <th class="text-center">الاجابه الثالثه</th>
                                <th class="text-center">الاجابه الرابعه</th>
                                <th class="text-center">الاجابه الخامسه</th>
                                <th class="text-center">الاجابه الصحيحه</th>


                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($questions as $question)
                            <tr id="row_{{$question->id}}">
        @php
            // Extract file extension for the question
            $fileExtension = strtolower(pathinfo($question->question, PATHINFO_EXTENSION));
            $fileExtension1 = strtolower(pathinfo($question->option1, PATHINFO_EXTENSION));
            $fileExtension2 = strtolower(pathinfo($question->option2, PATHINFO_EXTENSION));
            $fileExtension3 = strtolower(pathinfo($question->option3, PATHINFO_EXTENSION));
            $fileExtension4 = strtolower(pathinfo($question->option4, PATHINFO_EXTENSION));
            $fileExtension5 = strtolower(pathinfo($question->option5, PATHINFO_EXTENSION));
            $fileExtension6 = strtolower(pathinfo($question->correct_answer, PATHINFO_EXTENSION));

        @endphp



        <!-- First Column (Question Content) -->
        <td class="text-center">
            @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                <img src="{{ asset('uploads/QuestionCourse/' . $question->question) }}" alt="Image" width="100">
            @elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg']))
                <video width="200" controls>
                    <source src="{{ asset('uploads/QuestionCourse/' . $question->question) }}" type="video/{{ $fileExtension }}">
                    Your browser does not support the video tag.
                </video>
            @elseif (in_array($fileExtension, ['mp3', 'wav', 'ogg']))
                <audio controls>
                    <source src="{{ asset('uploads/QuestionCourse/' . $question->question) }}" type="audio/{{ $fileExtension }}">
                    Your browser does not support the audio tag.
                </audio>
            @else
                {{ $question->question }}
            @endif
        </td>

        <!-- Sffffffffffecond Column (Options) -->

        <td class="text-center">
    @if (in_array($fileExtension1, ['jpg', 'jpeg', 'png', 'gif']))
        <img src="{{ asset('uploads/OptionsCourse/option1/' . $question->option1) }}" alt="Image" width="100">
    @elseif (in_array($fileExtension1, ['mp4', 'webm', 'ogg']))
        <video width="200" controls>
            <source src="{{ asset('uploads/OptionsCourse/option1/' . $question->option1) }}" type="video/{{ $fileExtension1 }}">
            Your browser does not support the video tag.
        </video>
    @elseif (in_array($fileExtension1, ['mp3', 'wav', 'ogg']))
        <audio controls>
            <source src="{{ asset('uploads/OptionsCourse/option1/' . $question->option1) }}" type="audio/{{ $fileExtension1 }}">
            Your browser does not support the audio tag.
        </audio>
    @else
        {{ $question->option1 }}
    @endif
        </td>

        <td class="text-center">
    @if (in_array($fileExtension2, ['jpg', 'jpeg', 'png', 'gif']))
        <img src="{{ asset('uploads/OptionsCourse/option2/' . $question->option2) }}" alt="Image" width="100">
    @elseif (in_array($fileExtension2, ['mp4', 'webm', 'ogg']))
        <video width="200" controls>
            <source src="{{ asset('uploads/OptionsCourse/option2/' . $question->option2) }}" type="video/{{ $fileExtension2 }}">
            Your browser does not support the video tag.
        </video>
    @elseif (in_array($fileExtension2, ['mp3', 'wav', 'ogg']))
        <audio controls>
            <source src="{{ asset('uploads/OptionsCourse/option2/' . $question->option2) }}" type="audio/{{ $fileExtension2 }}">
            Your browser does not support the audio tag.
        </audio>
    @else
        {{ $question->option2 }}
    @endif
        </td>

        <td class="text-center">
    @if (in_array($fileExtension3, ['jpg', 'jpeg', 'png', 'gif']))
        <img src="{{ asset('uploads/OptionsCourse/option3/' . $question->option3) }}" alt="Image" width="100">
    @elseif (in_array($fileExtension3, ['mp4', 'webm', 'ogg']))
        <video width="200" controls>
            <source src="{{ asset('uploads/OptionsCourse/option3/' . $question->option3) }}" type="video/{{ $fileExtension3 }}">
            Your browser does not support the video tag.
        </video>
    @elseif (in_array($fileExtension3, ['mp3', 'wav', 'ogg']))
        <audio controls>
            <source src="{{ asset('uploads/OptionsCourse/option3/' . $question->option3) }}" type="audio/{{ $fileExtension3 }}">
            Your browser does not support the audio tag.
        </audio>
    @else
        {{ $question->option3 }}
    @endif
        </td>

        <td class="text-center">
    @if (in_array($fileExtension4, ['jpg', 'jpeg', 'png', 'gif']))
        <img src="{{ asset('uploads/OptionsCourse/option4/' . $question->option4) }}" alt="Image" width="100">
    @elseif (in_array($fileExtension4, ['mp4', 'webm', 'ogg']))
        <video width="200" controls>
            <source src="{{ asset('uploads/OptionsCourse/option4/' . $question->option4) }}" type="video/{{ $fileExtension4 }}">
            Your browser does not support the video tag.
        </video>
    @elseif (in_array($fileExtension4, ['mp3', 'wav', 'ogg']))
        <audio controls>
            <source src="{{ asset('uploads/OptionsCourse/option4/' . $question->option4) }}" type="audio/{{ $fileExtension4 }}">
            Your browser does not support the audio tag.
        </audio>
    @else
        {{ $question->option4 }}
    @endif
        </td>

        <td class="text-center">
    @if (in_array($fileExtension5, ['jpg', 'jpeg', 'png', 'gif']))
        <img src="{{ asset('uploads/OptionsCourse/option5/' . $question->option5) }}" alt="Image" width="100">
    @elseif (in_array($fileExtension5, ['mp4', 'webm', 'ogg']))
        <video width="200" controls>
            <source src="{{ asset('uploads/OptionsCourse/option5/' . $question->option5) }}" type="video/{{ $fileExtension5 }}">
            Your browser does not support the video tag.
        </video>
    @elseif (in_array($fileExtension5, ['mp3', 'wav', 'ogg']))
        <audio controls>
            <source src="{{ asset('uploads/OptionsCourse/option5/' . $question->option5) }}" type="audio/{{ $fileExtension5 }}">
            Your browser does not support the audio tag.
        </audio>
    @else
        {{ $question->option5 }}
    @endif
        </td>


        <!-- Photo Column (Image) -->
        <td class="text-center">
    @if (in_array($fileExtension6, ['jpg', 'jpeg', 'png', 'gif']))
        <img src="{{ asset('uploads/Correct_AnswerCourse/' . $question->correct_answer) }}" alt="Image" width="100">
    @elseif (in_array($fileExtension6, ['mp4', 'webm', 'ogg']))
        <video width="200" controls>
            <source src="{{ asset('uploads/Correct_AnswerCourse/' . $question->correct_answer) }}" type="video/{{ $fileExtension6 }}">
            Your browser does not support the video tag.
        </video>
    @elseif (in_array($fileExtension6, ['mp3', 'wav', 'ogg']))
        <audio controls>
            <source src="{{ asset('uploads/Correct_AnswerCourse/' . $question->correct_answer) }}" type="audio/{{ $fileExtension6 }}">
            Your browser does not support the audio tag.
        </audio>
    @else
        {{ $question->correct_answer }}
    @endif
        </td>

        <!-- Action Buttons (Edit and Delete) -->
        <td class="text-center">
            <a href="javascript:;" data-bs-target="#editcourse{{$question->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{ trans('common.edit') }}">
                <i data-feather='edit'></i>
            </a>

            <?php $delete = route('newcourse.question_seperate.delete', ['id' => $question->id]); ?>
            <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}', '{{$question->id}}')">
                <i data-feather='trash-2'></i>
            </button>
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

                {{ $questions->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->

    @foreach($questions as $question)
    <div class="modal fade text-md-start" id="editcourse{{$question->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
    <div class="modal-content">
        <div class="modal-header bg-transparent">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pb-5 px-sm-5 pt-50">
            <div class="text-center mb-2">
                <h1 class="mb-1">{{trans('common.UpdateQuestion')}}</h1>
            </div>
            {{Form::open(['url'=>route('newcourse.question_seperate.update', $question->id), 'id'=>'updateQuestionForm'.$question->id, 'class'=>'row gy-1 pt-75','files'=>'true'])}}

            <!-- عرض وتعديل السؤال -->
<div class="row">
    <div class="col-12 col-md-8">
        <label class="form-label" for="question">{{ trans('السؤال') }}</label>
        @php
            // Extract the file extension for the question
            $fileExtension7 = strtolower(pathinfo($question->question, PATHINFO_EXTENSION));
        @endphp
        <div id="questionInputWrapper">
            @if (in_array($fileExtension7, ['jpg', 'jpeg', 'png', 'gif']))
                <!-- Display image -->
                <img src="{{ asset('uploads/QuestionCourse/' . $question->question) }}" alt="Image" width="100">
                {{ Form::file('question', ['id' => 'question', 'class' => 'form-control']) }}
            @elseif (in_array($fileExtension7, ['mp4', 'webm', 'ogg']))
                <!-- Display video -->
                <video width="200" controls>
                    <source src="{{ asset('uploads/QuestionCourse/' . $question->question) }}" type="video/{{ $fileExtension7 }}">
                    Your browser does not support the video tag.
                </video>
                {{ Form::file('question', ['id' => 'question', 'class' => 'form-control']) }}
            @elseif (in_array($fileExtension7, ['mp3', 'wav', 'ogg']))
                <!-- Display audio -->
                <audio controls>
                    <source src="{{ asset('uploads/QuestionCourse/' . $question->question) }}" type="audio/{{ $fileExtension7 }}">
                    Your browser does not support the audio tag.
                </audio>
                {{ Form::file('question', ['id' => 'question', 'class' => 'form-control']) }}
            @else
                <!-- Display text input for non-file questions -->
                {{ Form::text('question', $question->question, ['id' => 'question', 'class' => 'form-control']) }}
            @endif
        </div>
    </div>
</div>


            <!-- عرض وتعديل الخيارات -->
            <div class="row mt-3">
    @for ($i = 1; $i <= 5; $i++)
        <div class="col-12 col-md-3">
            <label class="form-label" for="option{{ $i }}">{{ trans('الاجابه') }} {{ $i }}</label>

            @php
                $optionValue = $question->{'option'.$i}; // Dynamically access the property
                $fileExtension = strtolower(pathinfo($optionValue, PATHINFO_EXTENSION));
            @endphp

            <div id="inputWrapper{{ $i }}">
                @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                    <!-- Display image -->
                    <img src="{{ asset('uploads/OptionsCourse/option'.$i.'/' . $optionValue) }}" alt="Image" width="100">
                    {{ Form::file('option'.$i, ['id' => 'option'.$i, 'class' => 'form-control']) }}

                @elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg']))
                    <!-- Display video -->
                    <video width="200" controls>
                        <source src="{{ asset('uploads/OptionsCourse/option'.$i.'/' . $optionValue) }}" type="video/{{ $fileExtension }}">
                        Your browser does not support the video tag.
                    </video>
                    <br>
                    {{ Form::file('option'.$i, ['id' => 'option'.$i, 'class' => 'form-control']) }}

                @elseif (in_array($fileExtension, ['mp3', 'wav', 'ogg']))
                    <!-- Display audio -->
                    <audio controls>
                        <source src="{{ asset('uploads/OptionsCourse/option'.$i.'/' . $optionValue) }}" type="audio/{{ $fileExtension }}">
                        Your browser does not support the audio element.
                    </audio>
                    <br>
                    {{ Form::file('option'.$i, ['id' => 'option'.$i, 'class' => 'form-control']) }}

                @else
                    <!-- Default to text input -->
                    {{ Form::text('option'.$i, $optionValue, ['id' => 'option'.$i, 'class' => 'form-control']) }}
                @endif
            </div>
        </div>
    @endfor
</div>


            <!-- عرض وتعديل الإجابة الصحيحة -->
            <div class="row">
    <div class="col-12 col-md-8">
        <label class="form-label" for="correct_answer">{{ trans('الاجابه الص') }}</label>
        @php
            // Extract the file extension for the correct answer
            $fileExtension9 = strtolower(pathinfo($question->correct_answer, PATHINFO_EXTENSION));
        @endphp
        <div id="questionInputWrapper">
            @if (in_array($fileExtension9, ['jpg', 'jpeg', 'png', 'gif']))
                <!-- Display image -->
                <img src="{{ asset('uploads/Correct_AnswerCourse/' . $question->correct_answer) }}" alt="Image" width="100">
                {{ Form::file('correct_answer', ['id' => 'correct_answer', 'class' => 'form-control']) }}
            @elseif (in_array($fileExtension9, ['mp4', 'webm', 'ogg']))
                <!-- Display video -->
                <video width="200" controls>
                    <source src="{{ asset('uploads/Correct_AnswerCourse/' . $question->correct_answer) }}" type="video/{{ $fileExtension9 }}">
                    Your browser does not support the video tag.
                </video>
                {{ Form::file('correct_answer', ['id' => 'correct_answer', 'class' => 'form-control']) }}
            @elseif (in_array($fileExtension9, ['mp3', 'wav', 'ogg']))
                <!-- Display audio -->
                <audio controls>
                    <source src="{{ asset('uploads/Correct_AnswerCourse/' . $question->correct_answer) }}" type="audio/{{ $fileExtension9 }}">
                    Your browser does not support the audio tag.
                </audio>
                {{ Form::file('correct_answer', ['id' => 'correct_answer', 'class' => 'form-control']) }}
            @else
                <!-- If it's not a file, display a text input -->
                {{ Form::text('correct_answer', $question->correct_answer, ['id' => 'correct_answer', 'class' => 'form-control']) }}
            @endif
        </div>
    </div>
</div>


            <!-- أزرار الحفظ والإلغاء -->
            <div class="row d-flex justify-content-center mt-3">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                        {{trans('common.Cancel')}}
                    </button>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>

    </div>
@endforeach




@stop




@section('page_buttons')
    @if ($active != 'curriculums')

        <a href="{{route('admin.newCourse.instructors')}}" class="btn btn-primary btn-sm">
            المحاضرين
        </a>
    @endif
    <a href="javascript:;" data-bs-target="#createcourse" data-bs-toggle="modal" class="btn btn-primary btn-sm">
        {{trans('common.CreateNew')}}
    </a>

    <div class="modal fade text-md-start" id="createcourse" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                    </div>
                    {{Form::open(['url'=>route('newcourse.question_seperate.store',$quiz_id), 'id'=>'createcourseForm', 'class'=>'row gy-1 pt-75','files'=>'true'])}}


                    <div class="row">
    <div class="col-12 col-md-8">
        <label class="form-label" for="question">{{ trans('السؤال') }}</label>

        <select class="form-select mb-2" id="questionInputType" onchange="changeQuestionInputType()">
            <option value="text">Text</option>
            <option value="file">File</option>
        </select>

        <div id="questionInputWrapper">
            {{ Form::text('question', '', ['id' => 'question', 'class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>
                        <!-- @if ($active != 'curriculums')
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="section_id">القسم</label>
                                {{Form::select('section_id',sectionsList(),'',['id'=>'section_id', 'class'=>'selectpicker'])}}
                            </div>
                        @endif -->
                        <div class="col-12"></div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary" onclick="changeAllInputs('text')">Set All to Text</button>
                                <button type="button" class="btn btn-secondary" onclick="changeAllInputs('file')">Set All to File</button>
                            </div>
                        </div>

                                        <div class="row">
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="option{{ $i }}">{{ trans('الاجابه') }} {{ $i }}</label>

                            <div id="inputWrapper{{ $i }}">
                                <input type="text" name="option{{ $i }}"id="option{{$i}}"class="form-control" {{ $i <= 3 ? 'required' : '' }}>
                            </div>
                        </div>
                    @endfor
                </div>



                        <!-- <div class="col-12"></div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="details_ar">{{trans('common.des_ar')}}</label>
                            {!!Form::textarea('details_ar','',['id'=>'details_ar', 'class'=>'form-control editor_ar'])!!}
                        </div> -->
                        <!-- <div class="col-12 col-md-12">
                            <label class="form-label" for="details_en">{{trans('common.des_en')}}</label>
                            {!!Form::textarea('details_en','',['id'=>'details_en', 'class'=>'form-control editor_ar'])!!}
                        </div> -->
                                                <div class="col-12 col-md-3">
                            <label class="form-label" for="correct_answer">{{ trans('الاجابه الصحيحه') }}</label>

                            <select class="form-select mb-2" id="correctAnswerInputType" onchange="changeCorrectAnswerInputType()">
                                <option value="text">Text</option>
                                <option value="file">File</option>
                            </select>

                            <div id="correctAnswerInputWrapper">
                                {{ Form::text('correct_answer', '', ['id' => 'correct_answer', 'class' => 'form-control', 'required']) }}
                            </div>
                        </div>

                        <!-- <div class="col-12 col-md-12">
                            <label class="form-label" for="seo_keywords">SEO الكلمات الدليلية</label>
                            {!!Form::textarea('seo_keywords','',['id'=>'seo_keywords', 'class'=>'form-control','rows'=>'3'])!!}
                        </div> -->

                        <div class="row d-flex justify-content-center">


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

<script>
    function changeQuestionInputType() {
        const inputType = document.getElementById('questionInputType').value;
        const inputWrapper = document.getElementById('questionInputWrapper');

        // Clear existing content in the wrapper
        inputWrapper.innerHTML = '';

        // Add the appropriate input based on the selected type
        if (inputType === 'text') {
            inputWrapper.innerHTML = `<input type="text" name="question" id="question" class="form-control" required>`;
        } else if (inputType === 'file') {
            inputWrapper.innerHTML = `<input type="file" name="question" id="question" class="form-control" required>`;
        }
    }
</script>

<script>
function changeAllInputs(type) {
    for (let i = 1; i <= 5; i++) {
        const inputWrapper = document.getElementById(`inputWrapper${i}`);

        // Clear existing content in the wrapper
        inputWrapper.innerHTML = '';

        // Create a new input element
        const input = document.createElement('input');
        input.name = `option${i}`;
        input.id = `option${i}`;
        input.className = 'form-control';
        input.type = type;

        // Set the 'required' attribute for the first three inputs
        if (i <= 3) {
            input.setAttribute('required', '');
        }

        // Append the new input to the wrapper
        inputWrapper.appendChild(input);
    }
}

</script>

<script>
    function changeCorrectAnswerInputType() {
        const inputType = document.getElementById('correctAnswerInputType').value;
        const inputWrapper = document.getElementById('correctAnswerInputWrapper');

        // Clear existing content in the wrapper
        inputWrapper.innerHTML = '';

        // Add the appropriate input based on the selected type
        if (inputType === 'text') {
            inputWrapper.innerHTML = `<input type="text" name="correct_answer" id="correct_answer" class="form-control" required>`;
        } else if (inputType === 'file') {
            inputWrapper.innerHTML = `<input type="file" name="correct_answer" id="correct_answer" class="form-control" required>`;
        }
    }
</script>

<script>
    function changeInputType(fieldId) {
    const inputType = document.getElementById(`${fieldId}InputType`).value;
    const wrapper = document.getElementById(`${fieldId}InputWrapper`);

    if (inputType === 'text') {
        wrapper.innerHTML = `<input type="text" name="${fieldId}" id="${fieldId}" class="form-control" required>`;
    } else {
        wrapper.innerHTML = `<input type="file" name="${fieldId}" id="${fieldId}" class="form-control">`;
    }
}
function is_text($value) {
    return !is_file($value) && !empty($value);
}

function is_file($value) {
    return file_exists(public_path('uploads/OptionsCourse/'.$value));
}
</script>



