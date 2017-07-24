<div class="form-group">
    {!! Form::label('subject', 'Survey Name:') !!}
    {{Form::text('subject',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {!! Form::label('description', 'Survey Objective:') !!}
    {{Form::textarea('description',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    <label class="control-label">Period</label>
    <div class="input-group  date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
        {{Form::date('starts_at', \Carbon\Carbon::now(),['class'=>'form-control'])}}
        <span class="input-group-btn">
            <button class="btn default" type="button">
                <i class="fa fa-calendar"></i>
            </button>
        </span>
        <span class="input-group-addon"> to </span>
        {{Form::date('expires_at', \Carbon\Carbon::now(),['class'=>'form-control'])}}

        <span class="input-group-btn">
            <button class="btn default" type="button">
                <i class="fa fa-calendar"></i>
            </button>
        </span>
    </div>
</div>

@if($update)
    {{Form::hidden('project_id',$survey->project_id)}}
@else
    {{Form::hidden('project_id',$project->id)}}
@endif

<div class="form-group">
    <?php $criteria = $update ? $survey->getTargetCriteria() : []?>
    <label class="control-label">Beneficiaries</label>
    {!! Form::select('targets[]',$extra_types ,$criteria, ['multiple','data-style'=>'btn-default','placeholder'=>'Please Select Criteria','class' => 'selectpicker show-tick show-menu-arrow form-control']) !!}
</div>
<div class="form-group">
    @if(!$update)
        <div class="form-group col-sm-12 {{ $errors->has('area_id') ? 'has-error' : ''}}">
            {!! Form::label('social_worker_id[]', 'Available SocialWorkers:') !!}
            {{ Form::select('social_worker_id[]', $project->workers()->get()->pluck('user.name', 'id')->toArray() ,array(),['class'=>'selectpicker show-tick show-menu-arrow form-control','multiple'=>true,'data-style'=>"btn-default"]) }}
        </div>
    @else
        <div class="form-group col-sm-12 {{ $errors->has('area_id') ? 'has-error' : ''}}">
            {!! Form::label('social_worker_id[]', 'Available SocialWorkers:') !!}
            {{ Form::select('social_worker_id[]', $survey->project->workers()->get()->pluck('user.name', 'id')->toArray(),array_keys($survey->SocialWorkers()->get()->pluck('use.name','id')->toArray()),['class'=>'selectpicker show-tick show-menu-arrow form-control','multiple'=>true,'data-style'=>"btn-default"]) }}
        </div>
    @endif
</div>
<div class="margin-top-10">
    <button type="submit" class="btn green"> Add</button>
    <a href="{{route('endusers.org.projects.show',$update?$survey->project_id:$project->id)}}"
       class="btn default"> Cancel </a>
</div>
