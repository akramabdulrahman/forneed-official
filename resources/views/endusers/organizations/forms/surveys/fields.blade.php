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
    <?php $start = $update ? $survey->starts_at : \Carbon\Carbon::now(); ?>
    <?php $end = $update ? $survey->expires_at : \Carbon\Carbon::now(); ?>
    <div class="input-group  date date-picker input-daterange" data-date="10/11/2012">
        {{Form::text('starts_at', $start->toDateString(),['class'=>'form-control','id'=>'starts_at'])}}
        <span class="input-group-addon"> to </span>
        {{Form::text('expires_at', $end->toDateString(),['class'=>'form-control','id'=>'expires_at'])}}

    </div>
</div>
@if($update)
    {{Form::hidden('project_id',$survey->project_id)}}
@else
    {{Form::hidden('project_id',$project->id)}}
@endif

<div class="form-group">
    <?php $criteria = $update ? $survey->getTargetCriteria() : $project->getTargetCriteria()?>
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
@push('page_script_plugins')
    <script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>

    <script src="{{asset('js/datepicker.range.valid.js')}}"></script>

@endpush