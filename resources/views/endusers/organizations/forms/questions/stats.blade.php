{!! Form::open(['route'=>'Dashboard.ben.stats.post','class'=>'charts-form','id'=>'questions_stats_form'])!!}
<div class="form-group col-sm-10">
    {!! Form::label('sector_id', 'Theme:') !!}
    {{Form::hidden('survey_id',$survey->id)}}
    {{Form::select('theme',$libs,null,['class'=>'select2me show-tick show-menu-arrow form-control','data-style'=>"btn-default"]) }}
    <input type="hidden" name="multi" value="true">
</div>
<div class="form-group col-sm-10">
    {!! Form::label('func', 'Aggregation func:') !!}
    {{Form::select('func',$funcs,null,['class'=>'select2me show-tick show-menu-arrow form-control','data-style'=>"btn-default"]) }}

</div>

<div class="form-group col-sm-10">
    {!! Form::label('first_ans', 'First indicator:') !!}
    <select name="first_ans[]" id="second_ans" placeholder='Please Select Criteria'
            class="selectpicker show-tick show-menu-arrow form-control"
            multiple>
        @foreach($survey->questions as $quest)
            <optgroup id="{{$quest->id}}"
                      label="{{ucwords($quest->body).':'}}"
                      data-max-options="1">
                @foreach($quest->answers as $answer)
                    <option value="{{$answer->id}}">{{$answer->answer}}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-12">
    <a type="submit" class="btn btn blue hidden" id="question_stat" href="javascript:void(0);">Draw</a>
    <a type="submit" class="btn btn green hidden" id="question_stat_save" href="javascript:void(0);">Save</a>
</div>
{{Form::close()}}