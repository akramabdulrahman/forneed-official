<div class="form-group">
    {!! Form::label('name', 'Project Name:') !!}
    {{Form::text('name',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {!! Form::label('description', 'Project Description:') !!}
    {{Form::text('description',null,['class'=>'form-control'])}}
</div>

<?php $sectors = $update ? $project->extras->groupBy('name')->get('Sector')->pluck('id') : null?>

<div class="form-group">
    <div class="form-group col-sm-12">
        {!! Form::label('extras[Sector]', 'Sector:') !!}
        {!! Form::select('extras[Sector]',  $extras['Sector'] ,$sectors, ['data-style'=>'btn-default','placeholder'=>'Sector','class' => 'selectpicker show-tick show-menu-arrow form-control']) !!}
    </div>
</div>
<?php $areas = $update ? $project->extras->groupBy('name')->get('Area')->pluck('id') : null?>

<div class="form-group">
    <div class="form-group col-sm-12">
        {!! Form::label('extras[Area]', 'Area:') !!}
        {!! Form::select('extras[Area]',  $extras['Area'] ,$areas, ['data-style'=>'btn-default','placeholder'=>'Area','class' => 'selectpicker show-tick show-menu-arrow form-control']) !!}
    </div>
</div>
<div class="row form-group">
    <div class="form-group col-sm-6">
        {!! Form::label('sponsor', 'Donor:') !!}
        {{Form::text('sponsor',null,['class'=>'form-control'])}}
    </div>
</div>


<div class="form-group">
    <label class="control-label">Period</label>
    <?php $start = $update ? $project->starts_at : \Carbon\Carbon::now(); ?>
    <?php $end = $update ? $project->expires_at : \Carbon\Carbon::now(); ?>
    <div class="input-group  date date-picker input-daterange" data-date="10/11/2012">
        {{Form::text('starts_at', $start->toDateString(),['class'=>'form-control','id'=>'starts_at'])}}
        <span class="input-group-addon"> to </span>
        {{Form::text('expires_at', $end->toDateString(),['class'=>'form-control','id'=>'expires_at'])}}

    </div>
</div>
<div class="form-group">
    <?php $criteria = $update ? $project->extras->pluck('id', 'name')->whereNotIn('name', array_keys($extras))->toArray() : []?>
    <label class="control-label">Beneficiaries</label>
    {!! Form::select('targets[]',$extra_types ,$criteria, ['multiple','data-style'=>'btn-default','placeholder'=>'Please Select Criteria','class' => 'selectpicker show-tick show-menu-arrow form-control']) !!}
</div>
<div class="margin-top-10">
    <button type="submit" class="btn green"> Add</button>
    <a href="{{route('endusers.org.projects.list')}}" class="btn default"> Cancel </a>
</div>

@push('page_script_plugins')
    <script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>

    <script src="{{asset('js/datepicker.range.valid.js')}}"></script>

@endpush