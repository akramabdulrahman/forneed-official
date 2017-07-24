<div class="portlet light portlet-fit bordered question_container">
    <div class="portlet-body">
        <div class="form-group">
            {!! Form::label('body', 'Question Body:') !!}
            {{Form::text('body',null,['class'=>'form-control'])}}
        </div>
        {{Form::hidden('survey_id',$update?$question->survey_id:$survey_id)}}
        <div class="form-group">
            <label class="control-label">Answer</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="answer text" name="answer[]">
                <span class="input-group-btn">
                <button class="btn blue add-answer" type="button"><i
                            class="fa fa-plus"
                            aria-hidden="true"></i></button>
                </span>
            </div>
        </div>
        @if($update)
            @foreach($question->answers as $answer)
                <div class="form-group"><div class="input-group"><input type="text" value="{{$answer->answer}}" class="form-control" placeholder="answer text" name="answer[]"><span class="input-group-btn"><button class="btn red remove-answer" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button></span></div></div>
            @endforeach
        @endif

    </div>
</div>


<div class="margin-top-10">
    <button type="submit" class="btn green"> Add </button>
    <a href="{{route('endusers.org.projects.surveys.show',$update?$question->survey_id:$survey_id)}}"
       class="btn default"> Cancel </a>
</div>

@push('page_script_plugins')
<script src="{{asset('/dashboard/assets/js/system_js.js')}}"></script>
@endpush
